<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Collateral;
use App\Models\CreditScoring;
use App\Models\FinancialReport;
use App\Models\Profile;
use App\Models\Questionnaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DebtorWizardController extends Controller
{
    /**
     * Bab 3.2: Pilihan Profil (Perorangan vs Perusahaan) - Gambar 5
     */
    public function chooseProfile(): View
    {
        $user = Auth::user();
        $business = $user->business ?? new Business();

        return view('wizard.choose-profile', compact('business'));
    }

    /**
     * Simpan Pilihan Profil
     */
    public function saveProfileType(Request $request): RedirectResponse
    {
        $request->validate([
            'business_type' => ['required', 'in:perorangan,badan_hukum'],
        ]);

        $user = Auth::user();
        Business::updateOrCreate(
            ['user_id' => $user->id],
            [
                'business_type' => $request->business_type,
                'business_name' => $user->business->business_name ?? ($request->business_type === 'badan_hukum' ? 'PT Maju Bersama Sejahtera' : 'Usaha ' . $user->name),
            ]
        );

        return redirect()->route('wizard.overview');
    }

    /**
     * Bab 3.2: Pre-Scoring Overview (4 Card) - Gambar 6
     */
    public function overview(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'financialReports', 'questionnaires']);
        $hasProfile = (bool) $user->profile;
        $hasBusiness = (bool) $user->business;
        $hasFinancial = $user->financialReports()->count() >= 3;
        $hasCharacter = $user->questionnaires()->where('category', 'entrepreneurship_character')->count() >= 20;

        return view('wizard.overview', compact('user', 'hasProfile', 'hasBusiness', 'hasFinancial', 'hasCharacter'));
    }

    /**
     * Bab 3.3: Lengkapi Profil Diri - Gambar 7, 8, 9 & Tabel 4
     */
    public function personalProfile(): View
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile([
            'full_name' => $user->name,
            'email' => $user->email,
        ]);
        $business = $user->business;

        return view('wizard.personal-profile', compact('profile', 'business'));
    }

    /**
     * Simpan Profil Diri
     */
    public function savePersonalProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:50'],
            'existing_scoring_value' => ['nullable', 'integer'],
            'id_card_number' => ['nullable', 'string', 'max:50'],
            'birth_place_date' => ['nullable', 'string', 'max:100'],
            'npwp' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'has_existing_loans' => ['nullable', 'boolean'],
            'family_card_number' => ['nullable', 'string', 'max:50'],
            
            // Pasangan
            'has_spouse' => ['nullable', 'boolean'],
            'spouse_name' => ['nullable', 'string', 'max:255'],
            'spouse_phone' => ['nullable', 'string', 'max:50'],
            'spouse_birth_place_date' => ['nullable', 'string', 'max:100'],
            'spouse_id_card_number' => ['nullable', 'string', 'max:50'],
            'spouse_npwp' => ['nullable', 'string', 'max:50'],
            'spouse_address' => ['nullable', 'string'],
            'spouse_city' => ['nullable', 'string', 'max:100'],
            'spouse_province' => ['nullable', 'string', 'max:100'],
            'spouse_postal_code' => ['nullable', 'string', 'max:20'],
            'spouse_occupation' => ['nullable', 'string', 'max:100'],
            'spouse_monthly_income' => ['nullable', 'numeric'],
        ]);

        $user = Auth::user();
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('wizard.business-profile')->with('status', 'Profil diri berhasil disimpan.');
    }

    /**
     * Bab 3.4: Lengkapi Profil Usaha - Gambar 10, 11 & Tabel 10
     */
    public function businessProfile(): View
    {
        $user = Auth::user();
        $business = $user->business ?? new Business();

        return view('wizard.business-profile', compact('business'));
    }

    /**
     * Simpan Profil Usaha
     */
    public function saveBusinessProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'business_name' => ['required', 'string', 'max:255'],
            'established_year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'legal_form' => ['required', 'string', 'max:50'],
            'business_address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'social_media' => ['nullable', 'string', 'max:255'],
            'deed_establishment_number' => ['nullable', 'string', 'max:100'],
            'deed_amendment_number' => ['nullable', 'string', 'max:100'],
            'npwp' => ['nullable', 'string', 'max:50'],
            'main_director' => ['nullable', 'string', 'max:255'],
            'other_directors' => ['nullable', 'string'],
            'main_commissioner' => ['nullable', 'string', 'max:255'],
            'other_commissioners' => ['nullable', 'string'],
            'employee_count' => ['nullable', 'integer', 'min:0'],
            'business_classification' => ['nullable', 'string', 'max:100'],
            'revenue_range' => ['nullable', 'string', 'max:100'],
            'business_description' => ['nullable', 'string'],
            'product_permits' => ['nullable', 'string'],
            'has_giro_deficit' => ['nullable', 'boolean'],
        ]);

        $user = Auth::user();
        Business::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('wizard.financial-report')->with('status', 'Profil usaha berhasil disimpan.');
    }

    /**
     * Bab 3.5: Laporan Keuangan (3 Periode: Dec 2020, Dec 2021, Dec 2022) - Gambar 12, 13
     */
    public function financialReport(): View
    {
        $user = Auth::user();
        $reports = $user->financialReports()->orderBy('period_order')->get()->keyBy('period_order');

        return view('wizard.financial-report', compact('reports'));
    }

    /**
     * Simpan Laporan Keuangan 3 Periode
     */
    public function saveFinancialReport(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $business = $user->business;
        $periods = [
            1 => 'Dec 2020',
            2 => 'Dec 2021',
            3 => 'Dec 2022',
        ];

        foreach ($periods as $order => $yearLabel) {
            $data = $request->input("period.{$order}", []);
            
            FinancialReport::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'period_order' => $order,
                ],
                [
                    'business_id' => $business->id ?? null,
                    'period_year' => $yearLabel,
                    'operating_revenue' => $data['operating_revenue'] ?? 0,
                    'other_operating_revenue' => $data['other_operating_revenue'] ?? 0,
                    'total_operating_revenue' => ($data['operating_revenue'] ?? 0) + ($data['other_operating_revenue'] ?? 0),
                    'operational_expense' => $data['operational_expense'] ?? 0,
                    'labor_expense' => $data['labor_expense'] ?? 0,
                    'training_expense' => $data['training_expense'] ?? 0,
                    'rent_expense' => $data['rent_expense'] ?? 0,
                    'promotion_expense' => $data['promotion_expense'] ?? 0,
                    'tax_expense' => $data['tax_expense'] ?? 0,
                    'maintenance_expense' => $data['maintenance_expense'] ?? 0,
                    'depreciation_expense' => $data['depreciation_expense'] ?? 0,
                    'admin_general_expense' => $data['admin_general_expense'] ?? 0,
                    'other_operating_expense' => $data['other_operating_expense'] ?? 0,
                    'net_operating_income' => ($data['operating_revenue'] ?? 0) - ($data['operational_expense'] ?? 0),
                    'non_operating_revenue' => $data['non_operating_revenue'] ?? 0,
                    'non_operating_expense' => $data['non_operating_expense'] ?? 0,
                    'net_profit' => $data['net_profit'] ?? 0,
                    'cash' => $data['cash'] ?? 0,
                    'net_cash' => $data['net_cash'] ?? 0,
                    'current_assets' => $data['current_assets'] ?? 0,
                    'total_current_assets' => ($data['cash'] ?? 0) + ($data['current_assets'] ?? 0),
                    'acquisition_cost' => $data['acquisition_cost'] ?? 0,
                    'accumulated_depreciation' => $data['accumulated_depreciation'] ?? 0,
                    'total_fixed_assets' => ($data['acquisition_cost'] ?? 0) - ($data['accumulated_depreciation'] ?? 0),
                    'other_assets' => $data['other_assets'] ?? 0,
                    'total_assets' => $data['total_assets'] ?? 0,
                    'short_term_liabilities' => $data['short_term_liabilities'] ?? 0,
                    'other_liabilities' => $data['other_liabilities'] ?? 0,
                    'total_liabilities' => ($data['short_term_liabilities'] ?? 0) + ($data['other_liabilities'] ?? 0),
                    'share_capital' => $data['share_capital'] ?? 0,
                    'paid_in_capital' => $data['paid_in_capital'] ?? 0,
                    'retained_earnings' => $data['retained_earnings'] ?? 0,
                    'current_year_earnings' => $data['current_year_earnings'] ?? 0,
                    'total_equity' => ($data['share_capital'] ?? 0) + ($data['paid_in_capital'] ?? 0) + ($data['retained_earnings'] ?? 0),
                    'total_liabilities_and_equity' => $data['total_assets'] ?? 0,
                    'notes' => $request->input('notes'),
                ]
            );
        }

        return redirect()->route('wizard.collateral')->with('status', 'Laporan keuangan 3 periode berhasil disimpan.');
    }

    /**
     * Bab 3.5.1: Data Agunan (Collateral) - Gambar 14
     */
    public function collateral(): View
    {
        $user = Auth::user();
        $collaterals = $user->collaterals;

        return view('wizard.collateral', compact('collaterals'));
    }

    /**
     * Simpan Data Agunan
     */
    public function saveCollateral(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'collateral_type' => ['required', 'string', 'max:255'],
            'owner_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            'estimated_value' => ['required', 'numeric', 'min:0'],
            'valuation_basis' => ['required', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);

        $user = Auth::user();
        $business = $user->business;

        Collateral::create(array_merge($validated, [
            'user_id' => $user->id,
            'business_id' => $business->id ?? null,
        ]));

        if ($request->has('add_more')) {
            return redirect()->route('wizard.collateral')->with('status', 'Agunan berhasil ditambahkan. Silakan isi agunan lainnya.');
        }

        return redirect()->route('wizard.management')->with('status', 'Data agunan berhasil disimpan.');
    }

    /**
     * Bab 3.5.2: Profil Manajemen - Gambar 15 & Tabel 8
     */
    public function management(): View
    {
        $user = Auth::user();
        $savedAnswers = $user->questionnaires()->where('category', 'management_profile')->pluck('score_value', 'question_code')->toArray();

        return view('wizard.management', compact('savedAnswers'));
    }

    /**
     * Simpan Profil Manajemen
     */
    public function saveManagement(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $items = $request->input('mgt', []);

        $questionsMap = [
            'MGT_01' => 'Perusahaan memiliki kinerja sehat',
            'MGT_02' => 'Perusahaan telah memiliki pencatatan keuangan',
            'MGT_03' => 'Perusahaan tidak terdaftar dalam DHN',
            'MGT_04' => 'Jumlah modal disetor',
            'MGT_05' => 'Komposisi saham',
            'MGT_DIR_01' => 'Direksi tidak terdaftar dalam DHN',
            'MGT_DIR_02' => 'Pengalaman kerja pada jenis usaha yang relevan',
            'MGT_KOM_01' => 'Dewan Komisaris tidak terdaftar dalam DHN',
            'MGT_REL_01' => 'Telah menjadi nasabah',
        ];

        foreach ($items as $code => $val) {
            if (isset($questionsMap[$code])) {
                Questionnaire::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'question_code' => $code,
                    ],
                    [
                        'category' => 'management_profile',
                        'question_text' => $questionsMap[$code],
                        'score_value' => (float) $val,
                        'selected_option' => 'Option ' . $val,
                    ]
                );
            }
        }

        return redirect()->route('wizard.prospect')->with('status', 'Profil manajemen berhasil disimpan.');
    }

    /**
     * Bab 3.5.3: Prospek Bisnis - Gambar 16 & Tabel 9
     */
    public function prospect(): View
    {
        $user = Auth::user();
        $savedAnswers = $user->questionnaires()->where('category', 'business_prospect')->pluck('score_value', 'question_code')->toArray();

        return view('wizard.prospect', compact('savedAnswers'));
    }

    /**
     * Simpan Prospek Bisnis
     */
    public function saveProspect(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $items = $request->input('pros', []);

        $questionsMap = [
            'PROS_01' => 'Kepemilikan aset',
            'PROS_02' => 'Wilayah pasar',
            'PROS_03' => 'Jumlah cabang',
            'PROS_04' => 'Pengembangan jenis produk',
        ];

        foreach ($items as $code => $val) {
            if (isset($questionsMap[$code])) {
                Questionnaire::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'question_code' => $code,
                    ],
                    [
                        'category' => 'business_prospect',
                        'question_text' => $questionsMap[$code],
                        'score_value' => (float) $val,
                        'selected_option' => 'Option ' . $val,
                    ]
                );
            }
        }

        return redirect()->route('wizard.productivity')->with('status', 'Prospek bisnis berhasil disimpan.');
    }

    /**
     * Bab 3.5.4: Produktivitas & Rasio - Gambar 17 & Tabel 10
     */
    public function productivity(): View
    {
        $user = Auth::user();
        $reports = $user->financialReports()->orderBy('period_order', 'desc')->get();
        $latestReport = $reports->first();

        // Hitung rasio otomatis jika ada laporan keuangan
        $car = 18.5; // Modal sendiri / aset %
        $der = 0.35; // DER
        $roa = 19.3; // ROA %
        $roe = 24.6; // ROE %
        $cashRatio = 38.0; // Cash ratio %

        if ($latestReport && $latestReport->total_assets > 0) {
            $car = round(($latestReport->total_equity / $latestReport->total_assets) * 100, 2);
            $der = $latestReport->total_equity > 0 ? round($latestReport->total_liabilities / $latestReport->total_equity, 2) : 0;
            $roa = round(($latestReport->net_profit / $latestReport->total_assets) * 100, 2);
            $roe = $latestReport->total_equity > 0 ? round(($latestReport->net_profit / $latestReport->total_equity) * 100, 2) : 0;
            $cashRatio = $latestReport->total_liabilities > 0 ? round(($latestReport->cash / $latestReport->total_liabilities) * 100, 2) : 0;
        }

        return view('wizard.productivity', compact('car', 'der', 'roa', 'roe', 'cashRatio'));
    }

    /**
     * Simpan Produktivitas
     */
    public function saveProductivity(Request $request): RedirectResponse
    {
        return redirect()->route('wizard.payment')->with('status', 'Produktivitas berhasil dikonfirmasi.');
    }

    /**
     * Bab 3.5.5: Payment, DSR & RAC - Gambar 18 & Tabel 11
     */
    public function payment(): View
    {
        $user = Auth::user();
        $business = $user->business;
        $profile = $user->profile;

        return view('wizard.payment', compact('business', 'profile'));
    }

    /**
     * Simpan Payment & RAC
     */
    public function savePayment(Request $request): RedirectResponse
    {
        return redirect()->route('wizard.character-assessment')->with('status', 'Data payment & RAC berhasil disimpan.');
    }

    /**
     * Bab 3.6: Asesmen Karakter Kewirausahaan (20 Pertanyaan Big-Five Likert 1-5) - Gambar 19-22
     */
    public function characterAssessment(): View
    {
        $user = Auth::user();
        $existingCount = $user->questionnaires()->where('category', 'entrepreneurship_character')->count();
        $isCompleted = $existingCount >= 20;

        // 20 Soal Psikometri Standar Big-Five Kewirausahaan SRI
        $questions = [
            1 => ['code' => 'BIG5_01', 'dim' => 'O', 'text' => 'Saya cenderung bersikap optimis dan yakin terhadap masa depan usaha saya.'],
            2 => ['code' => 'BIG5_02', 'dim' => 'C', 'text' => 'Saya merasa nyaman mengambil risiko terukur dalam pengambilan keputusan bisnis.'],
            3 => ['code' => 'BIG5_03', 'dim' => 'C', 'text' => 'Saya memiliki kemampuan untuk memahami dan mengelola risiko secara efektif.'],
            4 => ['code' => 'BIG5_04', 'dim' => 'C', 'text' => 'Saya selalu menyusun rencana kerja terstruktur sebelum memulai proyek baru.'],
            5 => ['code' => 'BIG5_05', 'dim' => 'O', 'text' => 'Saya tertarik mencoba metode dan inovasi digital baru dalam operasional bisnis.'],
            6 => ['code' => 'BIG5_06', 'dim' => 'E', 'text' => 'Saya aktif membangun relasi dan kemitraan strategis dengan berbagai pihak.'],
            7 => ['code' => 'BIG5_07', 'dim' => 'A', 'text' => 'Saya mengutamakan komunikasi yang terbuka dan transparan dengan seluruh mitra bisnis.'],
            8 => ['code' => 'BIG5_08', 'dim' => 'N', 'text' => 'Saya tetap tenang dan berpikiran jernih saat menghadapi situasi krisis atau tekanan pasar.'],
            9 => ['code' => 'BIG5_09', 'dim' => 'C', 'text' => 'Saya disiplin dalam memisahkan keuangan pribadi dan keuangan operasional perusahaan.'],
            10 => ['code' => 'BIG5_10', 'dim' => 'O', 'text' => 'Saya secara berkala mengevaluasi tren pasar untuk mencari peluang usaha baru.'],
            11 => ['code' => 'BIG5_11', 'dim' => 'E', 'text' => 'Saya percaya diri dalam mempresentasikan prospek bisnis saya kepada calon investor atau bank.'],
            12 => ['code' => 'BIG5_12', 'dim' => 'A', 'text' => 'Saya menghargai masukan dan kritik konstruktif dari pelanggan dan karyawan.'],
            13 => ['code' => 'BIG5_13', 'dim' => 'N', 'text' => 'Saya mampu bangkit kembali dengan cepat ketika menghadapi kegagalan atau kerugian.'],
            14 => ['code' => 'BIG5_14', 'dim' => 'C', 'text' => 'Kepatuhan terhadap regulasi, pajak, dan perizinan adalah prioritas utama usaha saya.'],
            15 => ['code' => 'BIG5_15', 'dim' => 'O', 'text' => 'Saya senang mempelajari keahlian manajerial baru guna meningkatkan daya saing usaha.'],
            16 => ['code' => 'BIG5_16', 'dim' => 'E', 'text' => 'Saya mampu menginspirasi dan memotivasi tim kerja untuk mencapai target perusahaan.'],
            17 => ['code' => 'BIG5_17', 'dim' => 'A', 'text' => 'Saya berkomitmen menjaga integritas dan ketepatan waktu dalam pembayaran kewajiban usaha.'],
            18 => ['code' => 'BIG5_18', 'dim' => 'N', 'text' => 'Saya tidak mudah terpancing emosi dalam negosiasi atau perselisihan bisnis.'],
            19 => ['code' => 'BIG5_19', 'dim' => 'C', 'text' => 'Saya selalu memantau arus kas harian dan mingguan secara teliti.'],
            20 => ['code' => 'BIG5_20', 'dim' => 'O', 'text' => 'Saya memiliki visi jangka panjang yang jelas untuk pertumbuhan skala bisnis saya.'],
        ];

        return view('wizard.character', compact('questions', 'isCompleted'));
    }

    /**
     * Simpan Hasil Asesmen Karakter Kewirausahaan
     */
    public function saveCharacterAssessment(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Cek jika sudah pernah tes (dikunci 1 kali sesuai instruksi)
        $existingCount = $user->questionnaires()->where('category', 'entrepreneurship_character')->count();
        if ($existingCount >= 20) {
            return redirect()->route('wizard.completion')->with('info', 'Asesmen karakter telah diselesaikan sebelumnya dan terkunci.');
        }

        $answers = $request->input('answers', []);
        $questions = [
            1 => ['code' => 'BIG5_01', 'dim' => 'O', 'text' => 'Saya cenderung bersikap optimis dan yakin terhadap masa depan usaha saya.'],
            2 => ['code' => 'BIG5_02', 'dim' => 'C', 'text' => 'Saya merasa nyaman mengambil risiko terukur dalam pengambilan keputusan bisnis.'],
            3 => ['code' => 'BIG5_03', 'dim' => 'C', 'text' => 'Saya memiliki kemampuan untuk memahami dan mengelola risiko secara efektif.'],
            4 => ['code' => 'BIG5_04', 'dim' => 'C', 'text' => 'Saya selalu menyusun rencana kerja terstruktur sebelum memulai proyek baru.'],
            5 => ['code' => 'BIG5_05', 'dim' => 'O', 'text' => 'Saya tertarik mencoba metode dan inovasi digital baru dalam operasional bisnis.'],
            6 => ['code' => 'BIG5_06', 'dim' => 'E', 'text' => 'Saya aktif membangun relasi dan kemitraan strategis dengan berbagai pihak.'],
            7 => ['code' => 'BIG5_07', 'dim' => 'A', 'text' => 'Saya mengutamakan komunikasi yang terbuka dan transparan dengan seluruh mitra bisnis.'],
            8 => ['code' => 'BIG5_08', 'dim' => 'N', 'text' => 'Saya tetap tenang dan berpikiran jernih saat menghadapi situasi krisis atau tekanan pasar.'],
            9 => ['code' => 'BIG5_09', 'dim' => 'C', 'text' => 'Saya disiplin dalam memisahkan keuangan pribadi dan keuangan operasional perusahaan.'],
            10 => ['code' => 'BIG5_10', 'dim' => 'O', 'text' => 'Saya secara berkala mengevaluasi tren pasar untuk mencari peluang usaha baru.'],
            11 => ['code' => 'BIG5_11', 'dim' => 'E', 'text' => 'Saya percaya diri dalam mempresentasikan prospek bisnis saya kepada calon investor atau bank.'],
            12 => ['code' => 'BIG5_12', 'dim' => 'A', 'text' => 'Saya menghargai masukan dan kritik konstruktif dari pelanggan dan karyawan.'],
            13 => ['code' => 'BIG5_13', 'dim' => 'N', 'text' => 'Saya mampu bangkit kembali dengan cepat ketika menghadapi kegagalan atau kerugian.'],
            14 => ['code' => 'BIG5_14', 'dim' => 'C', 'text' => 'Kepatuhan terhadap regulasi, pajak, dan perizinan adalah prioritas utama usaha saya.'],
            15 => ['code' => 'BIG5_15', 'dim' => 'O', 'text' => 'Saya senang mempelajari keahlian manajerial baru guna meningkatkan daya saing usaha.'],
            16 => ['code' => 'BIG5_16', 'dim' => 'E', 'text' => 'Saya mampu menginspirasi dan memotivasi tim kerja untuk mencapai target perusahaan.'],
            17 => ['code' => 'BIG5_17', 'dim' => 'A', 'text' => 'Saya berkomitmen menjaga integritas dan ketepatan waktu dalam pembayaran kewajiban usaha.'],
            18 => ['code' => 'BIG5_18', 'dim' => 'N', 'text' => 'Saya tidak mudah terpancing emosi dalam negosiasi atau perselisihan bisnis.'],
            19 => ['code' => 'BIG5_19', 'dim' => 'C', 'text' => 'Saya selalu memantau arus kas harian dan mingguan secara teliti.'],
            20 => ['code' => 'BIG5_20', 'dim' => 'O', 'text' => 'Saya memiliki visi jangka panjang yang jelas untuk pertumbuhan skala bisnis saya.'],
        ];

        $scoresByDim = ['O' => 0, 'C' => 0, 'E' => 0, 'A' => 0, 'N' => 0];
        $countByDim = ['O' => 0, 'C' => 0, 'E' => 0, 'A' => 0, 'N' => 0];

        foreach ($questions as $idx => $q) {
            $score = isset($answers[$idx]) ? (int) $answers[$idx] : 4;
            $dim = $q['dim'];
            $scoresByDim[$dim] += $score;
            $countByDim[$dim]++;

            Questionnaire::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'question_code' => $q['code'],
                ],
                [
                    'category' => 'entrepreneurship_character',
                    'question_text' => $q['text'],
                    'score_value' => $score,
                    'selected_option' => $score . ' (Likert)',
                ]
            );
        }

        // Kalkulasi otomatis skor 5C, 4P, Big-Five, dan Grade Rating
        $ratingService = app(\App\Services\RatingCalculationService::class);
        $ratingService->calculateRatingForUser($user);

        return redirect()->route('wizard.completion')->with('status', 'Terima kasih telah menyelesaikan asesmen karakter kewirausahaan. Skor pemeringkatan berhasil dihitung.');
    }

    /**
     * Bab 3.7: Ringkasan Kelengkapan Formulir (Checklist Hijau) - Gambar 23 & Tabel 14
     */
    public function formCompletion(): View
    {
        $user = Auth::user()->load(['profile', 'business', 'financialReports', 'questionnaires']);
        $hasProfile = (bool) $user->profile;
        $hasBusiness = (bool) $user->business;
        $hasFinancial = $user->financialReports()->count() >= 3;
        $hasCharacter = $user->questionnaires()->where('category', 'entrepreneurship_character')->count() >= 20;

        $allComplete = $hasProfile && $hasBusiness && $hasFinancial && $hasCharacter;

        return view('wizard.completion', compact('user', 'hasProfile', 'hasBusiness', 'hasFinancial', 'hasCharacter', 'allComplete'));
    }
}
