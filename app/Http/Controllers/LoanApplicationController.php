<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Collateral;
use App\Models\CreditScoring;
use App\Models\LoanApplication;
use App\Models\Partner;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoanApplicationController extends Controller
{
    /**
     * Bab 4: Pilihan Pengajuan 3 Track (Tahap 5)
     */
    public function chooseTrack(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'creditScoring', 'collaterals']);
        $scoring = $user->creditScoring;
        $collateralTotal = $user->collaterals()->sum('estimated_value');

        return view('application.choose', compact('user', 'scoring', 'collateralTotal'));
    }

    /**
     * Bab 4.1: Form Pengajuan Fasilitas Kredit (Gambar 28 - 32)
     */
    public function formKredit(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'creditScoring', 'collaterals']);
        $partners = Partner::where('is_active', true)->whereJsonContains('supported_tracks', 'kredit')->get();
        $scoring = $user->creditScoring;
        $collaterals = $user->collaterals;

        return view('application.form-kredit', compact('user', 'partners', 'scoring', 'collaterals'));
    }

    /**
     * Bab 4.2: Form Pengajuan Penjaminan Cash Loan (Gambar 33 - 35)
     */
    public function formCashLoan(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'creditScoring', 'collaterals']);
        $partners = Partner::where('is_active', true)->whereJsonContains('supported_tracks', 'cash_loan')->get();
        $scoring = $user->creditScoring;
        $collaterals = $user->collaterals;

        return view('application.form-cash-loan', compact('user', 'partners', 'scoring', 'collaterals'));
    }

    /**
     * Bab 4.3: Form Pengajuan Penjaminan Non-Cash Loan (Gambar 36 - 38)
     */
    public function formNonCashLoan(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'creditScoring', 'collaterals']);
        $partners = Partner::where('is_active', true)->whereJsonContains('supported_tracks', 'non_cash_loan')->get();
        $scoring = $user->creditScoring;
        $collaterals = $user->collaterals;

        return view('application.form-non-cash-loan', compact('user', 'partners', 'scoring', 'collaterals'));
    }

    /**
     * Simpan Pengajuan Pembiayaan & Generate TRX (Tahap 5 & 6)
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'submission_track' => ['required', 'in:kredit,cash_loan,non_cash_loan'],
            'partner_id' => ['required', 'exists:partners,id'],
            'loan_amount' => ['required', 'numeric', 'min:10000000'],
            'tenor_months' => ['required', 'integer', 'min:1', 'max:120'],
            'loan_purpose' => ['required', 'string'],
            'submission_region' => ['nullable', 'string', 'max:100'],
            'selected_product_type' => ['nullable', 'string', 'max:100'],
            'selected_product_name' => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $scoring = $user->creditScoring;
        $partner = Partner::findOrFail($request->partner_id);

        // Generate Transaction Code TRX[YYYY][RANDOM7]
        $trxId = 'TRX' . date('Y') . mt_rand(1000000, 9999999);

        $application = LoanApplication::create([
            'trx_id' => $trxId,
            'user_id' => $user->id,
            'business_id' => $user->business->id ?? null,
            'partner_id' => $partner->id,
            'credit_scoring_id' => $scoring->id ?? null,
            'submission_track' => $validated['submission_track'],
            'loan_amount' => $validated['loan_amount'],
            'tenor_months' => $validated['tenor_months'],
            'estimated_interest_rate' => $partner->interest_rate_min . '% - ' . $partner->interest_rate_max . '%',
            'loan_purpose' => $validated['loan_purpose'],
            'submission_region' => $validated['submission_region'] ?? 'DKI Jakarta & Nasional',
            'institution_types' => [$partner->category],
            'selected_product_type' => $validated['selected_product_type'] ?? 'Fasilitas Pembiayaan Terbuka',
            'selected_product_name' => $validated['selected_product_name'] ?? ($partner->name . ' SME Facility'),
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        return redirect()->route('apply.history')->with('trx_success', [
            'trx_id' => $trxId,
            'partner_name' => $partner->name,
            'amount' => $validated['loan_amount'],
            'track' => $validated['submission_track'],
        ]);
    }

    /**
     * Bab 4 & Bab 6: Rekomendasi Kesesuaian Mitra (Berdasarkan Rating SRI)
     */
    public function recommendations(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'creditScoring', 'collaterals']);
        $scoring = $user->creditScoring;
        $partners = Partner::where('is_active', true)->get();

        return view('application.recommendations', compact('user', 'scoring', 'partners'));
    }

    /**
     * Histori Pengajuan Debitur
     */
    public function history(): View
    {
        $user = Auth::user();
        $applications = LoanApplication::where('user_id', $user->id)
            ->with(['partner', 'creditScoring'])
            ->latest()
            ->get();

        return view('application.history', compact('user', 'applications'));
    }
}
