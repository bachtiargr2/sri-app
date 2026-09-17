<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Collateral;
use App\Models\CreditScoring;
use App\Models\FinancialReport;
use App\Models\LoanApplication;
use App\Models\Partner;
use App\Models\Profile;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with full demo data for all 6 SRI steps.
     */
    public function run(): void
    {
        // 1. Create Demo Debtor User (Ibu Jessica as per PDF screenshots)
        $user = User::updateOrCreate(
            ['email' => 'jess@gmail.com'],
            [
                'name' => 'Ibu Jessica',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Profile Debitur (Bab 3.3)
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'full_name' => 'Jessica Pangestu',
                'position' => 'Direktur Utama',
                'email' => 'jess@gmail.com',
                'phone_number' => '082177766899',
                'existing_scoring_value' => 740,
                'scoring_certificate_path' => 'documents/cert_jessica.pdf',
                'id_card_number' => '123848484939020',
                'birth_place_date' => 'Jakarta, 19/11/1980',
                'npwp' => '8383892020389',
                'address' => 'Ritz Carlton SCBD Tower A-12',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12345',
                'has_existing_loans' => false,
                'family_card_number' => '3171012345678901',
                'has_spouse' => false,
            ]
        );

        // 3. Profil Usaha (Bab 3.4)
        $business = Business::updateOrCreate(
            ['user_id' => $user->id],
            [
                'business_type' => 'badan_hukum',
                'business_name' => 'PT Maju Bersama Sejahtera',
                'established_year' => 2015,
                'legal_form' => 'PT',
                'business_address' => 'Jl. Jenderal Sudirman Kav. 52-53, Jakarta Selatan',
                'phone' => '0215150000',
                'email' => 'corporate@majubersama.co.id',
                'website' => 'https://majubersama.co.id',
                'social_media' => '@majubersama_official',
                'deed_establishment_number' => 'AHU-0012938.AH.01.01.TAHUN 2015',
                'deed_amendment_number' => 'AHU-0098234.AH.01.02.TAHUN 2022',
                'npwp' => '01.234.567.8-012.000',
                'main_director' => 'Jessica Pangestu',
                'other_directors' => 'Budi Santoso (Direktur Operasional)',
                'main_commissioner' => 'Hendrawan Pratama',
                'other_commissioners' => 'Siti Rahmawati',
                'employee_count' => 35,
                'business_classification' => 'Perdagangan Besar & Manufaktur Ringan',
                'revenue_range' => 'Rp 5 Miliar - Rp 10 Miliar',
                'business_description' => 'Perusahaan bergerak di bidang penyediaan suku cadang industri dan logistik terpadu untuk kawasan industri modern.',
                'product_permits' => 'NIB, SIUP, TDP, Izin Edar Kemenkes RI, ISO 9001:2015',
                'has_giro_deficit' => false,
            ]
        );

        // 4. Laporan Keuangan 3 Periode (Bab 3.5, Gambar 12 & 13)
        $periods = [
            [
                'period_year' => 'Dec 2020',
                'period_order' => 1,
                'operating_revenue' => 4500000000,
                'other_operating_revenue' => 120000000,
                'total_operating_revenue' => 4620000000,
                'operational_expense' => 3200000000,
                'labor_expense' => 600000000,
                'training_expense' => 30000000,
                'rent_expense' => 120000000,
                'promotion_expense' => 50000000,
                'tax_expense' => 85000000,
                'maintenance_expense' => 40000000,
                'depreciation_expense' => 65000000,
                'admin_general_expense' => 75000000,
                'other_operating_expense' => 20000000,
                'net_operating_income' => 335000000,
                'non_operating_revenue' => 15000000,
                'non_operating_expense' => 10000000,
                'net_profit' => 340000000,
                'cash' => 450000000,
                'net_cash' => 380000000,
                'current_assets' => 850000000,
                'total_current_assets' => 1300000000,
                'acquisition_cost' => 1500000000,
                'accumulated_depreciation' => 150000000,
                'total_fixed_assets' => 1350000000,
                'other_assets' => 100000000,
                'total_assets' => 2750000000,
                'short_term_liabilities' => 450000000,
                'other_liabilities' => 200000000,
                'total_liabilities' => 650000000,
                'share_capital' => 1000000000,
                'paid_in_capital' => 500000000,
                'retained_earnings' => 260000000,
                'current_year_earnings' => 340000000,
                'total_equity' => 2100000000,
                'total_liabilities_and_equity' => 2750000000,
            ],
            [
                'period_year' => 'Dec 2021',
                'period_order' => 2,
                'operating_revenue' => 5800000000,
                'other_operating_revenue' => 150000000,
                'total_operating_revenue' => 5950000000,
                'operational_expense' => 4100000000,
                'labor_expense' => 750000000,
                'training_expense' => 45000000,
                'rent_expense' => 130000000,
                'promotion_expense' => 70000000,
                'tax_expense' => 110000000,
                'maintenance_expense' => 50000000,
                'depreciation_expense' => 80000000,
                'admin_general_expense' => 90000000,
                'other_operating_expense' => 30000000,
                'net_operating_income' => 495000000,
                'non_operating_revenue' => 20000000,
                'non_operating_expense' => 15000000,
                'net_profit' => 500000000,
                'cash' => 620000000,
                'net_cash' => 550000000,
                'current_assets' => 1100000000,
                'total_current_assets' => 1720000000,
                'acquisition_cost' => 1800000000,
                'accumulated_depreciation' => 230000000,
                'total_fixed_assets' => 1570000000,
                'other_assets' => 150000000,
                'total_assets' => 3440000000,
                'short_term_liabilities' => 580000000,
                'other_liabilities' => 260000000,
                'total_liabilities' => 840000000,
                'share_capital' => 1000000000,
                'paid_in_capital' => 500000000,
                'retained_earnings' => 600000000,
                'current_year_earnings' => 500000000,
                'total_equity' => 2600000000,
                'total_liabilities_and_equity' => 3440000000,
            ],
            [
                'period_year' => 'Dec 2022',
                'period_order' => 3,
                'operating_revenue' => 7400000000,
                'other_operating_revenue' => 180000000,
                'total_operating_revenue' => 7580000000,
                'operational_expense' => 5100000000,
                'labor_expense' => 900000000,
                'training_expense' => 60000000,
                'rent_expense' => 140000000,
                'promotion_expense' => 95000000,
                'tax_expense' => 145000000,
                'maintenance_expense' => 60000000,
                'depreciation_expense' => 95000000,
                'admin_general_expense' => 110000000,
                'other_operating_expense' => 35000000,
                'net_operating_income' => 840000000,
                'non_operating_revenue' => 25000000,
                'non_operating_expense' => 15000000,
                'net_profit' => 850000000,
                'cash' => 890000000,
                'net_cash' => 780000000,
                'current_assets' => 1450000000,
                'total_current_assets' => 2340000000,
                'acquisition_cost' => 2200000000,
                'accumulated_depreciation' => 325000000,
                'total_fixed_assets' => 1875000000,
                'other_assets' => 185000000,
                'total_assets' => 4400000000,
                'short_term_liabilities' => 650000000,
                'other_liabilities' => 300000000,
                'total_liabilities' => 950000000,
                'share_capital' => 1000000000,
                'paid_in_capital' => 500000000,
                'retained_earnings' => 1100000000,
                'current_year_earnings' => 850000000,
                'total_equity' => 3450000000,
                'total_liabilities_and_equity' => 4400000000,
            ],
        ];

        foreach ($periods as $p) {
            FinancialReport::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'period_year' => $p['period_year'],
                ],
                array_merge($p, ['business_id' => $business->id])
            );
        }

        // 5. Data Agunan (Bab 3.5.1)
        Collateral::updateOrCreate(
            [
                'user_id' => $user->id,
                'collateral_type' => 'Tanah & Bangunan Ruko Komersial',
            ],
            [
                'business_id' => $business->id,
                'owner_name' => 'Jessica Pangestu',
                'location' => 'Komplek Ruko Golden Boulevard Blok S-10, BSD City, Tangerang Selatan',
                'estimated_value' => 2500000000,
                'valuation_basis' => 'Jasa Penilai (Appraisal)',
                'supporting_document_path' => 'documents/shm_ruko_bsd.pdf',
                'photo_path' => 'images/agunan_ruko.jpg',
                'notes' => 'Sertifikat Hak Milik (SHM) No. 4920/BSD atas nama Jessica Pangestu, bebas sengketa.',
            ]
        );

        // 6. Kuesioner & Asesmen Karakter Big Five (Bab 3.5.2 - 3.6, Tabel 12 & 13)
        $questionnaires = [
            // Profil Manajemen (Tabel 8)
            ['category' => 'management_profile', 'code' => 'MGT_01', 'text' => 'Perusahaan memiliki kinerja sehat dan pertumbuhan stabil', 'score' => 5, 'opt' => 'Tiga tahun berturut-turut laba'],
            ['category' => 'management_profile', 'code' => 'MGT_02', 'text' => 'Perusahaan telah memiliki pencatatan keuangan teraudit', 'score' => 5, 'opt' => 'Tiga tahun berturut-turut audited KAP'],
            ['category' => 'management_profile', 'code' => 'MGT_03', 'text' => 'Perusahaan & Pengurus tidak terdaftar dalam DHN Bank Indonesia', 'score' => 5, 'opt' => 'Tidak pernah masuk dalam DHN'],
            ['category' => 'management_profile', 'code' => 'MGT_04', 'text' => 'Jumlah modal disetor >= Rp 500 Juta', 'score' => 5, 'opt' => '>= Rp 500 Juta'],
            ['category' => 'management_profile', 'code' => 'MGT_05', 'text' => 'Komposisi saham mayoritas pendiri', 'score' => 5, 'opt' => '> 51% Saham'],
            ['category' => 'management_profile', 'code' => 'MGT_DIR_01', 'text' => 'Direksi tidak terdaftar dalam DHN', 'score' => 5, 'opt' => 'Bersih DHN'],
            ['category' => 'management_profile', 'code' => 'MGT_DIR_02', 'text' => 'Pengalaman kerja direksi > 5 tahun', 'score' => 5, 'opt' => '> 5 Tahun'],
            ['category' => 'management_profile', 'code' => 'MGT_KOM_01', 'text' => 'Dewan Komisaris tidak terdaftar dalam DHN', 'score' => 5, 'opt' => 'Bersih DHN'],
            ['category' => 'management_profile', 'code' => 'MGT_REL_01', 'text' => 'Telah menjadi nasabah > 3 tahun', 'score' => 5, 'opt' => '> 3 Tahun'],

            // Prospek Bisnis (Tabel 9)
            ['category' => 'business_prospect', 'code' => 'PROS_01', 'text' => 'Status kepemilikan aset operasional milik sendiri', 'score' => 5, 'opt' => 'Milik Sendiri (SHM)'],
            ['category' => 'business_prospect', 'code' => 'PROS_02', 'text' => 'Cakupan wilayah pemasaran produk nasional / ekspor', 'score' => 5, 'opt' => 'Nasional & Regional'],
            ['category' => 'business_prospect', 'code' => 'PROS_03', 'text' => 'Jumlah cabang / titik outlet > 5 titik', 'score' => 5, 'opt' => '> 5 Titik Distribusi'],
            ['category' => 'business_prospect', 'code' => 'PROS_04', 'text' => 'Pengembangan & diversifikasi varian produk', 'score' => 5, 'opt' => '> 3 Varian Produk'],

            // Asesmen Karakter Kewirausahaan (20 Soal Big-Five Psikometri - Tabel 12 & 13)
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_01', 'text' => 'Saya cenderung bersikap optimis dan yakin terhadap masa depan usaha saya.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_02', 'text' => 'Saya merasa nyaman mengambil risiko terukur dalam pengambilan keputusan bisnis.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_03', 'text' => 'Saya memiliki kemampuan untuk memahami dan mengelola risiko secara efektif.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_04', 'text' => 'Saya selalu menyusun rencana kerja terstruktur sebelum memulai proyek baru.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_05', 'text' => 'Saya tertarik mencoba metode dan inovasi digital baru dalam operasional bisnis.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_06', 'text' => 'Saya aktif membangun relasi dan kemitraan strategis dengan berbagai pihak.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_07', 'text' => 'Saya mengutamakan komunikasi yang terbuka dan transparan dengan seluruh mitra bisnis.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_08', 'text' => 'Saya tetap tenang dan berpikiran jernih saat menghadapi situasi krisis atau tekanan pasar.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_09', 'text' => 'Saya disiplin dalam memisahkan keuangan pribadi dan keuangan operasional perusahaan.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_10', 'text' => 'Saya secara berkala mengevaluasi tren pasar untuk mencari peluang usaha baru.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_11', 'text' => 'Saya percaya diri dalam mempresentasikan prospek bisnis saya kepada calon investor atau bank.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_12', 'text' => 'Saya menghargai masukan dan kritik konstruktif dari pelanggan dan karyawan.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_13', 'text' => 'Saya mampu bangkit kembali dengan cepat ketika menghadapi kegagalan atau kerugian.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_14', 'text' => 'Kepatuhan terhadap regulasi, pajak, dan perizinan adalah prioritas utama usaha saya.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_15', 'text' => 'Saya senang mempelajari keahlian manajerial baru guna meningkatkan daya saing usaha.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_16', 'text' => 'Saya mampu menginspirasi dan memotivasi tim kerja untuk mencapai target perusahaan.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_17', 'text' => 'Saya berkomitmen menjaga integritas dan ketepatan waktu dalam pembayaran kewajiban usaha.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_18', 'text' => 'Saya tidak mudah terpancing emosi dalam negosiasi atau perselisihan bisnis.', 'score' => 4, 'opt' => '4 (Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_19', 'text' => 'Saya selalu memantau arus kas harian dan mingguan secara teliti.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
            ['category' => 'entrepreneurship_character', 'code' => 'BIG5_20', 'text' => 'Saya memiliki visi jangka panjang yang jelas untuk pertumbuhan skala bisnis saya.', 'score' => 5, 'opt' => '5 (Sangat Setuju)'],
        ];

        foreach ($questionnaires as $q) {
            Questionnaire::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'question_code' => $q['code'],
                ],
                [
                    'category' => $q['category'],
                    'question_text' => $q['text'],
                    'score_value' => $q['score'],
                    'selected_option' => $q['opt'],
                ]
            );
        }

        // 7. Hasil Pemeringkatan / Rating Sertifikat (Bab 3.8 & 3.9)
        $creditScoring = CreditScoring::updateOrCreate(
            ['user_id' => $user->id],
            [
                'business_id' => $business->id,
                'certificate_id' => 'CRTYES1230001',
                'credit_score' => 740,
                'rating_grade' => 'Bb',
                'rating_description' => 'Kredit baik, risiko rendah. Perusahaan memiliki kemampuan yang memadai untuk memenuhi kewajiban finansialnya.',
                
                // 5C
                'score_5c_character' => 30.00,
                'score_5c_capacity' => 10.00,
                'score_5c_collateral' => 13.00,
                'score_5c_capital' => 10.00,
                'score_5c_condition' => 12.00,
                'score_5c_total' => 75.00,

                // 4P
                'score_4p_personality' => 21.50,
                'score_4p_prospek' => 10.00,
                'score_4p_produktivitas' => 28.88,
                'score_4p_payment' => 19.20,
                'score_4p_total' => 79.58,

                // Big Five
                'big5_openness' => 82.00,
                'big5_conscientiousness' => 88.00,
                'big5_extraversion' => 75.00,
                'big5_agreeableness' => 80.00,
                'big5_neuroticism' => 25.00, // Rendah = Stabil Emosi
                'big5_summary' => 'Debitur memiliki karakter wirausaha tangguh, keterbukaan inovasi tinggi, kedisiplinan operasional sangat kuat, dan kestabilan emosi matang.',

                // SLIK
                'slik_status' => '1-Lancar',
                'slik_score' => 1,
                'summary_notes' => 'Hasil pemeringkatan memenuhi Risk Acceptance Criteria (RAC) untuk pengajuan kredit komersial dan penjaminan modal kerja.',
                'is_active' => true,
                'scoring_date' => now(),
            ]
        );

        // 8. Direktori Mitra & Lembaga Keuangan (Bab 5, Gambar 39)
        $partnersData = [
            [
                'name' => 'Bank BNI',
                'category' => 'Bank',
                'code' => 'BNI',
                'description' => 'Kredit Usaha Rakyat (KUR) & Kredit Modal Kerja Komersial BNI untuk UMKM Naik Kelas.',
                'interest_rate_min' => 1.00,
                'interest_rate_max' => 5.00,
                'max_tenor_months' => 60,
                'max_plafon' => 5000000000,
                'supported_tracks' => ['kredit', 'cash_loan'],
                'contact_email' => 'sme@bni.co.id',
                'contact_phone' => '1500046',
                'website' => 'https://www.bni.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'Bank Mandiri',
                'category' => 'Bank',
                'code' => 'MANDIRI',
                'description' => 'Fasilitas Kredit Usaha Produktif, Supply Chain Finance, dan Bank Garansi Mandiri.',
                'interest_rate_min' => 1.25,
                'interest_rate_max' => 5.50,
                'max_tenor_months' => 60,
                'max_plafon' => 10000000000,
                'supported_tracks' => ['kredit', 'non_cash_loan'],
                'contact_email' => 'commercial@bankmandiri.co.id',
                'contact_phone' => '14000',
                'website' => 'https://www.bankmandiri.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'Bank BSI',
                'category' => 'Bank',
                'code' => 'BSI',
                'description' => 'Pembiayaan Usaha Syariah (Akad Murabahah, Musyarakah Mutanaqisah) BSI SME.',
                'interest_rate_min' => 0.90,
                'interest_rate_max' => 4.50,
                'max_tenor_months' => 60,
                'max_plafon' => 5000000000,
                'supported_tracks' => ['kredit', 'cash_loan'],
                'contact_email' => 'sme@bankbsi.co.id',
                'contact_phone' => '14040',
                'website' => 'https://www.bankbsi.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'Jamkrindo',
                'category' => 'Lembaga Penjaminan',
                'code' => 'JAMKRINDO',
                'description' => 'Penjaminan Kredit Cash Loan (Kredit Modal Kerja/Investasi) dan Penjaminan Non-Cash Loan (Surety Bond, Bid Bond, Resi Gudang).',
                'interest_rate_min' => 0.50,
                'interest_rate_max' => 2.00,
                'max_tenor_months' => 36,
                'max_plafon' => 25000000000,
                'supported_tracks' => ['cash_loan', 'non_cash_loan'],
                'contact_email' => 'kontak@jamkrindo.co.id',
                'contact_phone' => '1500702',
                'website' => 'https://www.jamkrindo.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'Jamkrindo Syariah',
                'category' => 'Lembaga Penjaminan',
                'code' => 'JAMKRINDO_SYARIAH',
                'description' => 'Kafalah Penjaminan Pembiayaan Syariah dan Kontra Bank Garansi Syariah.',
                'interest_rate_min' => 0.50,
                'interest_rate_max' => 1.80,
                'max_tenor_months' => 36,
                'max_plafon' => 15000000000,
                'supported_tracks' => ['cash_loan', 'non_cash_loan'],
                'contact_email' => 'info@jamsyar.co.id',
                'contact_phone' => '0212988888',
                'website' => 'https://www.jamsyar.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'Jamkrida Jakarta',
                'category' => 'Lembaga Penjaminan',
                'code' => 'JAMKRIDA_JKT',
                'description' => 'PT Penjaminan Kredit Daerah Jakarta melayani penjaminan kredit UMKM wilayah Jabodetabek.',
                'interest_rate_min' => 0.60,
                'interest_rate_max' => 2.20,
                'max_tenor_months' => 36,
                'max_plafon' => 5000000000,
                'supported_tracks' => ['cash_loan', 'non_cash_loan'],
                'contact_email' => 'sekretariat@jamkrida-jakarta.co.id',
                'contact_phone' => '0213890123',
                'website' => 'https://jamkrida-jakarta.co.id',
                'is_active' => true,
            ],
        ];

        $partners = [];
        foreach ($partnersData as $pd) {
            $partners[$pd['code']] = Partner::updateOrCreate(['code' => $pd['code']], $pd);
        }

        // 9. Loan Application Demo (Bab 4, Gambar 28, 30)
        LoanApplication::updateOrCreate(
            ['trx_id' => 'TRX1230001'],
            [
                'user_id' => $user->id,
                'business_id' => $business->id,
                'partner_id' => $partners['BNI']->id ?? null,
                'credit_scoring_id' => $creditScoring->id,
                'submission_track' => 'kredit',
                'loan_amount' => 80000000.00,
                'tenor_months' => 24,
                'estimated_interest_rate' => '1% - 5% per bulan',
                'loan_purpose' => 'Ekspansi bisnis dan penambahan stok barang di gudang sentral',
                'submission_region' => 'DKI Jakarta',
                'institution_types' => ['Bank', 'LK Non-Bank'],
                'selected_product_type' => 'Program (KUR)',
                'selected_product_name' => 'BNI untuk UMKM',
                'status' => 'submitted',
                'submitted_at' => now(),
            ]
        );
    }
}
