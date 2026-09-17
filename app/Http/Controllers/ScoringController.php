<?php

namespace App\Http\Controllers;

use App\Models\CreditScoring;
use App\Services\RatingCalculationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ScoringController extends Controller
{
    protected RatingCalculationService $ratingService;

    public function __construct(RatingCalculationService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Bab 3.9: Halaman Ringkasan Hasil Penilaian (Visualisasi Chart.js 4P, 5C, Big-Five)
     */
    public function summary(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'financialReports', 'questionnaires', 'creditScoring', 'collaterals']);
        
        // Pastikan credit scoring terhitung
        $scoring = $user->creditScoring;
        if (!$scoring) {
            $scoring = $this->ratingService->calculateRatingForUser($user);
        }

        $latestReport = $user->financialReports()->orderBy('period_order', 'desc')->first();
        $collateralTotal = $user->collaterals()->sum('estimated_value');

        return view('scoring.summary', compact('user', 'scoring', 'latestReport', 'collateralTotal'));
    }

    /**
     * Bab 3.10: Halaman Sertifikat Pemeringkatan Resmi SRI (Gambar 26)
     */
    public function certificate(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'financialReports', 'questionnaires', 'creditScoring']);
        
        $scoring = $user->creditScoring;
        if (!$scoring) {
            $scoring = $this->ratingService->calculateRatingForUser($user);
        }

        return view('scoring.certificate', compact('user', 'scoring'));
    }

    /**
     * Trigger rekalkulasi skoring otomatis
     */
    public function recalculate(): RedirectResponse
    {
        $user = Auth::user();
        $this->ratingService->calculateRatingForUser($user);

        return redirect()->route('scoring.summary')->with('status', 'Kalkulasi ulang pemeringkatan berhasil diperbarui.');
    }
}
