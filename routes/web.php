<?php

use App\Http\Controllers\DebtorWizardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user()->load(['profile', 'business', 'financialReports', 'questionnaires', 'creditScoring', 'loanApplications']);
    $scoring = $user->creditScoring;
    $hasProfile = (bool) $user->profile;
    $hasBusiness = (bool) $user->business;
    $hasFinancial = $user->financialReports()->count() >= 3;
    $hasCharacter = $user->questionnaires()->where('category', 'entrepreneurship_character')->count() >= 20;
    $partners = \App\Models\Partner::where('is_active', true)->get();
    $applications = $user->loanApplications()->with('partner')->latest()->get();

    return view('dashboard', compact('user', 'scoring', 'hasProfile', 'hasBusiness', 'hasFinancial', 'hasCharacter', 'partners', 'applications'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Wizard Alur Pengisian Data Calon Debitur (Bab 3.2 - Bab 3.7)
    Route::prefix('wizard')->name('wizard.')->group(function () {
        // Bab 3.2: Pilihan Profil Usaha (Perorangan vs Perusahaan) - Gambar 5
        Route::get('/choose-profile', [DebtorWizardController::class, 'chooseProfile'])->name('choose-profile');
        Route::post('/choose-profile', [DebtorWizardController::class, 'saveProfileType'])->name('save-profile-type');

        // Bab 3.2: Overview Menu Pra-Skoring (4 Card) - Gambar 6
        Route::get('/overview', [DebtorWizardController::class, 'overview'])->name('overview');

        // Bab 3.3: Lengkapi Profil Diri - Gambar 7, 8, 9
        Route::get('/personal-profile', [DebtorWizardController::class, 'personalProfile'])->name('personal-profile');
        Route::post('/personal-profile', [DebtorWizardController::class, 'savePersonalProfile'])->name('save-personal-profile');

        // Bab 3.4: Lengkapi Profil Usaha - Gambar 10, 11
        Route::get('/business-profile', [DebtorWizardController::class, 'businessProfile'])->name('business-profile');
        Route::post('/business-profile', [DebtorWizardController::class, 'saveBusinessProfile'])->name('save-business-profile');

        // Bab 3.5: Laporan Keuangan 3 Periode - Gambar 12, 13
        Route::get('/financial-report', [DebtorWizardController::class, 'financialReport'])->name('financial-report');
        Route::post('/financial-report', [DebtorWizardController::class, 'saveFinancialReport'])->name('save-financial-report');

        // Bab 3.5.1: Data Agunan (Collateral) - Gambar 14
        Route::get('/collateral', [DebtorWizardController::class, 'collateral'])->name('collateral');
        Route::post('/collateral', [DebtorWizardController::class, 'saveCollateral'])->name('save-collateral');

        // Bab 3.5.2: Profil Manajemen - Gambar 15
        Route::get('/management', [DebtorWizardController::class, 'management'])->name('management');
        Route::post('/management', [DebtorWizardController::class, 'saveManagement'])->name('save-management');

        // Bab 3.5.3: Prospek Bisnis - Gambar 16
        Route::get('/prospect', [DebtorWizardController::class, 'prospect'])->name('prospect');
        Route::post('/prospect', [DebtorWizardController::class, 'saveProspect'])->name('save-prospect');

        // Bab 3.5.4: Produktivitas & Rasio - Gambar 17
        Route::get('/productivity', [DebtorWizardController::class, 'productivity'])->name('productivity');
        Route::post('/productivity', [DebtorWizardController::class, 'saveProductivity'])->name('save-productivity');

        // Bab 3.5.5: Payment, DSR & RAC - Gambar 18
        Route::get('/payment', [DebtorWizardController::class, 'payment'])->name('payment');
        Route::post('/payment', [DebtorWizardController::class, 'savePayment'])->name('save-payment');

        // Bab 3.6: Asesmen Karakter Kewirausahaan (20 Pertanyaan Big-Five Likert 1-5) - Gambar 19-22
        Route::get('/character-assessment', [DebtorWizardController::class, 'characterAssessment'])->name('character-assessment');
        Route::post('/character-assessment', [DebtorWizardController::class, 'saveCharacterAssessment'])->name('save-character-assessment');

        // Bab 3.7: Ringkasan Kelengkapan Formulir (Checklist Hijau) - Gambar 23
        Route::get('/completion', [DebtorWizardController::class, 'formCompletion'])->name('completion');
    });

    // Bab 3.8 - 3.10: Hasil Pemeringkatan & Sertifikat SRI
    Route::prefix('scoring')->name('scoring.')->group(function () {
        Route::get('/summary', [\App\Http\Controllers\ScoringController::class, 'summary'])->name('summary');
        Route::get('/certificate', [\App\Http\Controllers\ScoringController::class, 'certificate'])->name('certificate');
        Route::post('/recalculate', [\App\Http\Controllers\ScoringController::class, 'recalculate'])->name('recalculate');
    });

    // Bab 4 & Bab 6: Tahap 4, 5, 6 - Pilihan Pengajuan & Rekomendasi Mitra (Terkunci jika belum ada rating)
    Route::middleware('scored.debtor')->group(function () {
        Route::prefix('apply')->name('apply.')->group(function () {
            Route::get('/', [\App\Http\Controllers\LoanApplicationController::class, 'chooseTrack'])->name('choose');
            Route::get('/kredit', [\App\Http\Controllers\LoanApplicationController::class, 'formKredit'])->name('kredit');
            Route::get('/cash-loan', [\App\Http\Controllers\LoanApplicationController::class, 'formCashLoan'])->name('cash_loan');
            Route::get('/non-cash-loan', [\App\Http\Controllers\LoanApplicationController::class, 'formNonCashLoan'])->name('non_cash_loan');
            Route::post('/store', [\App\Http\Controllers\LoanApplicationController::class, 'store'])->name('store');
            Route::get('/recommendations', [\App\Http\Controllers\LoanApplicationController::class, 'recommendations'])->name('recommendations');
            Route::get('/history', [\App\Http\Controllers\LoanApplicationController::class, 'history'])->name('history');
        });
    });

    // Bab 5: Direktori Mitra & Afiliasi SRI (Gambar 39 - 41)
    Route::get('/partners', [\App\Http\Controllers\PartnerDirectoryController::class, 'index'])->name('partners.index');
});

require __DIR__.'/auth.php';

