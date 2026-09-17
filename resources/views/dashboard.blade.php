<x-app-layout>
    <div class="py-8" x-data="{
        activeTab: 'skoring',
        showCertModal: false,
        showApplyModal: false,
        applyType: 'kredit',
        selectedPartner: null,
        trxCode: '',
        loanAmount: 1500000000,
        loanTenor: 36,
        submitApplication() {
            this.trxCode = 'TRX' + Math.floor(100000000 + Math.random() * 900000000);
            this.showApplyModal = false;
            alert('Pengajuan ' + this.applyType.toUpperCase() + ' Berhasil Dikirim ke Mitra! No Transaksi: ' + this.trxCode);
            window.location.reload();
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 1. Visual Stepper 6 Tahap (Strict Business Flow - Bab 2 & AGENTS.md) -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4 pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Alur Pemeringkatan & Pengajuan Finansial SRI (6 Tahap)</h2>
                        <p class="text-xs text-slate-500">Selesaikan setiap tahap secara berurutan untuk membuka fasilitas kredit & penjaminan.</p>
                    </div>
                    @if($scoring)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Tahap 1, 2, 3 Selesai &bull; Rating Aktif ({{ $scoring->rating_grade }} / {{ $scoring->credit_score }})
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Tahap 1 Selesai &bull; Menunggu Pengisian Data (Tahap 2)
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    <!-- Step 1: Pendaftaran Akun -->
                    <div class="p-3 rounded-xl bg-emerald-50/70 border border-emerald-200 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-bold flex items-center justify-center">✓</span>
                            <span class="text-[10px] font-bold text-emerald-700 uppercase">Selesai</span>
                        </div>
                        <p class="text-xs font-bold text-slate-900 leading-tight">1. Pendaftaran Pengguna</p>
                    </div>

                    <!-- Step 2: Pengisian Data Calon Debitur -->
                    <div class="p-3 rounded-xl {{ ($hasProfile && $hasBusiness && $hasFinancial && $hasCharacter) ? 'bg-emerald-50/70 border border-emerald-200' : 'bg-blue-50 border-2 border-blue-600 shadow-sm' }} flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-6 h-6 rounded-full {{ ($hasProfile && $hasBusiness && $hasFinancial && $hasCharacter) ? 'bg-emerald-600 text-white' : 'bg-blue-600 text-white' }} text-xs font-bold flex items-center justify-center">
                                {{ ($hasProfile && $hasBusiness && $hasFinancial && $hasCharacter) ? '✓' : '2' }}
                            </span>
                            <span class="text-[10px] font-bold {{ ($hasProfile && $hasBusiness && $hasFinancial && $hasCharacter) ? 'text-emerald-700' : 'text-blue-700' }} uppercase">
                                {{ ($hasProfile && $hasBusiness && $hasFinancial && $hasCharacter) ? 'Selesai' : 'Tahap Aktif' }}
                            </span>
                        </div>
                        @if($hasProfile && $hasBusiness && $hasFinancial && $hasCharacter)
                            <p class="text-xs font-bold text-slate-900 leading-tight">2. Pengisian Data Calon Debitur</p>
                        @else
                            <a href="{{ route('wizard.choose-profile') }}" class="text-xs font-bold text-blue-900 leading-tight hover:underline">
                                2. Pengisian Data Calon Debitur
                            </a>
                        @endif
                    </div>

                    <!-- Step 3: Hasil Pemeringkatan -->
                    <div class="p-3 rounded-xl {{ $scoring ? 'bg-emerald-50/70 border border-emerald-200' : 'bg-slate-50 border border-slate-200 opacity-60' }} flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-6 h-6 rounded-full {{ $scoring ? 'bg-emerald-600 text-white' : 'bg-slate-300 text-slate-600' }} text-xs font-bold flex items-center justify-center">
                                {{ $scoring ? '✓' : '3' }}
                            </span>
                            <span class="text-[10px] font-bold {{ $scoring ? 'text-emerald-700' : 'text-slate-400' }} uppercase">
                                {{ $scoring ? 'Selesai' : 'Terkunci' }}
                            </span>
                        </div>
                        <p class="text-xs font-bold {{ $scoring ? 'text-slate-900' : 'text-slate-600' }} leading-tight">3. Hasil Pemeringkatan</p>
                    </div>

                    <!-- Step 4: Rekomendasi Pembiayaan -->
                    <div class="p-3 rounded-xl {{ $scoring ? 'bg-blue-50 border border-blue-300' : 'bg-slate-50 border border-slate-200 opacity-60' }} flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-6 h-6 rounded-full {{ $scoring ? 'bg-blue-600 text-white' : 'bg-slate-300 text-slate-600' }} text-xs font-bold flex items-center justify-center">4</span>
                            <span class="text-[10px] font-bold {{ $scoring ? 'text-blue-700' : 'text-slate-400' }} uppercase">
                                {{ $scoring ? 'Terbuka' : 'Terkunci' }}
                            </span>
                        </div>
                        <p class="text-xs font-bold {{ $scoring ? 'text-blue-900' : 'text-slate-600' }} leading-tight">4. Rekomendasi Pembiayaan</p>
                    </div>

                    <!-- Step 5: Pilihan Pengajuan Track -->
                    <div class="p-3 rounded-xl {{ $scoring ? 'bg-blue-50 border border-blue-300' : 'bg-slate-50 border border-slate-200 opacity-60' }} flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-6 h-6 rounded-full {{ $scoring ? 'bg-blue-600 text-white' : 'bg-slate-300 text-slate-600' }} text-xs font-bold flex items-center justify-center">5</span>
                            <span class="text-[10px] font-bold {{ $scoring ? 'text-blue-700' : 'text-slate-400' }} uppercase">
                                {{ $scoring ? 'Terbuka' : 'Terkunci' }}
                            </span>
                        </div>
                        <p class="text-xs font-bold {{ $scoring ? 'text-blue-900' : 'text-slate-600' }} leading-tight">5. Pilihan Pengajuan Track</p>
                    </div>

                    <!-- Step 6: Kolaborasi Mitra -->
                    <div class="p-3 rounded-xl {{ $scoring ? 'bg-indigo-50 border border-indigo-300' : 'bg-slate-50 border border-slate-200 opacity-60' }} flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-6 h-6 rounded-full {{ $scoring ? 'bg-indigo-600 text-white' : 'bg-slate-300 text-slate-600' }} text-xs font-bold flex items-center justify-center">6</span>
                            <span class="text-[10px] font-bold {{ $scoring ? 'text-indigo-700' : 'text-slate-400' }} uppercase">
                                {{ $scoring ? 'Aktif' : 'Terkunci' }}
                            </span>
                        </div>
                        <p class="text-xs font-bold {{ $scoring ? 'text-indigo-900' : 'text-slate-600' }} leading-tight">6. Kolaborasi Mitra Bank/Penjamin</p>
                    </div>
                </div>
            </div>

            <!-- 2. Action Tabs Menu (Sesuai Gambar 27: Skoring, Kredit, Penjaminan Cash Loan, Penjaminan Non-Cash Loan) -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2.5">
                    <!-- Tab 1: Skoring -->
                    <button type="button" 
                            @click="activeTab = 'skoring'"
                            :class="activeTab === 'skoring' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                            class="px-6 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Skoring
                    </button>

                    @if($scoring)
                        <!-- Tab 2: Kredit (Unlocked) -->
                        <button type="button" 
                                @click="activeTab = 'kredit'; applyType = 'kredit'; showApplyModal = true"
                                :class="activeTab === 'kredit' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                                class="px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Kredit
                        </button>

                        <!-- Tab 3: Penjaminan Cash Loan (Unlocked) -->
                        <button type="button" 
                                @click="activeTab = 'cash_loan'; applyType = 'cash_loan'; showApplyModal = true"
                                :class="activeTab === 'cash_loan' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                                class="px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Penjaminan Cash Loan
                        </button>

                        <!-- Tab 4: Penjaminan Non-Cash Loan (Unlocked) -->
                        <button type="button" 
                                @click="activeTab = 'non_cash_loan'; applyType = 'non_cash_loan'; showApplyModal = true"
                                :class="activeTab === 'non_cash_loan' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'"
                                class="px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Penjaminan Non-Cash Loan
                        </button>
                    @else
                        <!-- Tabs locked state -->
                        <button type="button" title="Lengkapi data skoring terlebih dahulu" class="px-5 py-2.5 rounded-xl font-semibold text-xs text-slate-400 bg-white border border-slate-200 cursor-not-allowed flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Kredit
                        </button>
                        <button type="button" title="Lengkapi data skoring terlebih dahulu" class="px-5 py-2.5 rounded-xl font-semibold text-xs text-slate-400 bg-white border border-slate-200 cursor-not-allowed flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Penjaminan Cash Loan
                        </button>
                        <button type="button" title="Lengkapi data skoring terlebih dahulu" class="px-5 py-2.5 rounded-xl font-semibold text-xs text-slate-400 bg-white border border-slate-200 cursor-not-allowed flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Penjaminan Non-Cash Loan
                        </button>
                    @endif
                </div>

                <!-- Right Status Tag as per Gambar 27 -->
                <div class="text-right flex items-center md:justify-end gap-3">
                    <div class="text-xs text-slate-500">
                        Status Pengajuan: 
                        @if($applications->count() > 0)
                            <span class="font-bold text-emerald-600">{{ $applications->first()->application_status }} ({{ $applications->first()->application_code }})</span>
                        @elseif($scoring)
                            <span class="font-bold text-blue-600">Siap Diajukan ke Mitra</span>
                        @else
                            <span class="font-bold text-slate-700">Draft / Belum Ada</span>
                        @endif
                    </div>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('wizard.completion') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                        Kelengkapan Formulir
                    </a>
                </div>
            </div>

            <!-- Callout CTA Alert for Step 2 or Active Status -->
            @if(!$scoring)
                <div class="rounded-2xl bg-gradient-to-r from-blue-900 to-indigo-900 p-6 text-white shadow-lg flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded bg-blue-500/30 text-[10px] font-bold uppercase tracking-wider text-blue-200">Langkah Berikutnya</span>
                            <h3 class="text-base font-bold text-white">Lengkapi Profil dan Data Usaha Anda</h3>
                        </div>
                        <p class="text-xs text-blue-200/90 max-w-2xl leading-relaxed">
                            Anda belum melakukan proses pemeringkatan. Silakan isi Profil Diri, Profil Usaha, Laporan Keuangan 3 periode, Data Agunan, Profil Manajemen, dan Asesmen Karakter Kewirausahaan untuk memperoleh Sertifikat Rating & rekomendasi kredit.
                        </p>
                    </div>
                    <a href="{{ route('wizard.choose-profile') }}" class="shrink-0 px-6 py-3 rounded-xl font-bold text-xs text-blue-900 bg-white hover:bg-blue-50 shadow-md transition duration-150 transform hover:-translate-y-0.5 inline-block text-center">
                        Mulai Isi Formulir Sekarang &rarr;
                    </a>
                </div>
            @else
                <!-- Active Scoring Summary Banner -->
                <div class="rounded-2xl bg-gradient-to-r from-[#1E40AF] via-blue-800 to-indigo-900 p-6 text-white shadow-lg flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded bg-emerald-500/30 text-[10px] font-bold uppercase tracking-wider text-emerald-300">Rating Terbit</span>
                            <span class="text-xs text-blue-200 font-mono">No: {{ $scoring->certificate_id }}</span>
                        </div>
                        <h3 class="text-lg font-black text-white">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }} &bull; Rating {{ $scoring->rating_grade }} (Skor {{ $scoring->credit_score }})</h3>
                        <p class="text-xs text-blue-200/90 max-w-2xl leading-relaxed">
                            {{ $scoring->rating_description }} &bull; Rekomendasi Plafon: <strong class="text-white">Rp 1.500.000.000</strong> &bull; Tenor 36 Bulan
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" 
                                @click="showCertModal = true"
                                class="shrink-0 px-5 py-3 rounded-xl font-bold text-xs text-white bg-blue-600 hover:bg-blue-500 shadow-md transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Lihat Sertifikat Rating
                        </button>
                        <a href="{{ route('wizard.completion') }}" class="shrink-0 px-5 py-3 rounded-xl font-bold text-xs text-blue-900 bg-white hover:bg-blue-50 shadow-md transition">
                            Cek Formulir
                        </a>
                    </div>
                </div>
            @endif

            <!-- 3. Grid Panels Sesuai Gambar 27 & Bab 3 SRI -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Panel 1: Resume dan Skoring (Left Column, Top) -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Resume dan Skoring</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $scoring ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $scoring ? 'Terverifikasi' : 'Pending' }}
                            </span>
                        </div>
                        <h3 class="mt-3 text-base font-bold text-slate-900">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}</h3>
                        <p class="text-xs text-slate-500 mt-1">Status Verifikasi Calon Debitur</p>
                    </div>

                    @if($scoring)
                        <div class="my-6 p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2.5 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Bentuk Usaha:</span>
                                <strong class="text-slate-800">{{ strtoupper($user->business->legal_form ?? 'PT') }}</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Total Aset:</span>
                                <strong class="text-slate-800">Rp 4.020.000.000</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Omzet Tahunan:</span>
                                <strong class="text-slate-800">Rp 6.250.000.000</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Nilai Agunan SHM:</span>
                                <strong class="text-emerald-700">Rp 2.500.000.000 (166%)</strong>
                            </div>
                        </div>
                    @else
                        <div class="my-8 py-6 rounded-xl bg-slate-50/70 border border-dashed border-slate-200 text-center">
                            <div class="w-10 h-10 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-slate-600 block">Belum Tersedia</span>
                            <p class="text-xs text-slate-400 mt-1">Data resume skoring akan muncul setelah formulir dinilai</p>
                        </div>
                    @endif

                    <div class="text-xs text-slate-400 flex items-center justify-between pt-3 border-t border-slate-100">
                        <span>Plafon Rekomendasi</span>
                        <span class="font-bold text-slate-900">{{ $scoring ? 'Rp 1.500.000.000' : '-' }}</span>
                    </div>
                </div>

                <!-- Panel 2: Hasil Skoring Usaha (Middle Column, Top) -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Hasil Skoring Usaha</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700">Model 4P</span>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <h3 class="text-sm font-bold text-slate-800">Kinerja & Kapasitas Usaha</h3>
                            <a href="{{ route('scoring.summary') }}" class="text-[11px] font-bold text-blue-600 hover:underline">Rincian &rarr;</a>
                        </div>
                    </div>

                    @if($scoring)
                        <div class="my-3 h-44 w-full relative">
                            <canvas id="dashboardChart4P"></canvas>
                        </div>
                    @else
                        <div class="my-8 py-10 rounded-xl bg-slate-50/70 border border-dashed border-slate-200 text-center flex flex-col items-center justify-center">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-500">Data belum tersedia</span>
                            <p class="text-[11px] text-slate-400 mt-1">Perhitungan rasio finansial & manajemen</p>
                        </div>
                    @endif

                    <div class="text-xs text-slate-400 flex items-center justify-between pt-3 border-t border-slate-100">
                        <span>Skor Total 4P</span>
                        <span class="font-black text-blue-900">{{ $scoring ? $scoring->score_4p_total . ' / 100' : '0.00 / 100' }}</span>
                    </div>
                </div>

                <!-- Panel 3: Hasil Psikotes Kewirausahaan (Right Column, Top) -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Hasil Psikotes Kewirausahaan</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700">Big-Five Radar</span>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <h3 class="text-sm font-bold text-slate-800">Karakter & Potensi Pengusaha</h3>
                            <a href="{{ route('scoring.summary') }}" class="text-[11px] font-bold text-purple-600 hover:underline">Rincian &rarr;</a>
                        </div>
                    </div>

                    @if($scoring)
                        <div class="my-3 h-44 w-full relative">
                            <canvas id="dashboardChartRadar"></canvas>
                        </div>
                    @else
                        <div class="my-8 py-10 rounded-xl bg-slate-50/70 border border-dashed border-slate-200 text-center flex flex-col items-center justify-center">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-500">Data belum tersedia</span>
                            <p class="text-[11px] text-slate-400 mt-1">Grafik radar psikogram kepribadian bisnis</p>
                        </div>
                    @endif

                    <div class="text-xs text-slate-400 flex items-center justify-between pt-3 border-t border-slate-100">
                        <span>Status Asesmen</span>
                        <span class="font-bold {{ $scoring ? 'text-emerald-700' : 'text-amber-600' }}">
                            {{ $scoring ? '20 Soal Selesai' : 'Belum Mengisi' }}
                        </span>
                    </div>
                </div>

                <!-- Panel 4: Hasil Rating & Unduh Sertifikat (Bottom Left) -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Hasil Rating</span>
                            <span class="text-xs font-semibold text-slate-400">Skor SRI</span>
                        </div>
                        <h3 class="mt-3 text-sm font-bold text-slate-800">Peringkat & Kelayakan Kredit</h3>
                    </div>

                    @if($scoring)
                        <div class="my-4 text-center">
                            <div class="py-4 px-6 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 inline-block w-full">
                                <span class="text-4xl font-black text-blue-900 block tracking-tight">{{ $scoring->rating_grade }}</span>
                                <span class="text-xs text-blue-700 font-bold mt-1 block">Skor: {{ $scoring->credit_score }} / 1000</span>
                                <span class="text-[11px] text-slate-600 mt-1 block font-medium">{{ $scoring->rating_description }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('scoring.certificate') }}" 
                               class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow-md transition flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Buka Sertifikat Resmi SRI &rarr;
                            </a>
                        </div>
                    @else
                        <div class="my-6 text-center">
                            <div class="py-4 px-6 rounded-2xl bg-slate-50 border border-slate-200 inline-block w-full">
                                <span class="text-2xl font-black text-slate-400 block tracking-wider">Belum Tersedia</span>
                                <span class="text-xs text-slate-400 font-medium">Estimasi Rating: - / -</span>
                            </div>
                        </div>

                        <div>
                            <button type="button" 
                                    disabled
                                    class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Unduh Sertifikat
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Panel 5: Hasil Skoring Idscore / SLIK Skoring (Bottom Right, spanning 2 columns) -->
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Hasil Skoring Idscore / SLIK Skoring</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-700">SLIK OJK</span>
                        </div>
                        <h3 class="mt-3 text-sm font-bold text-slate-800">Riwayat Fasilitas Kredit Eksternal</h3>
                    </div>

                    @if($scoring)
                        <div class="my-4 p-4 rounded-xl bg-slate-50 border border-slate-200 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                            <div>
                                <span class="text-slate-500 block">Kolektibilitas SLIK:</span>
                                <span class="inline-flex items-center gap-1 font-bold text-emerald-700 mt-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    {{ $scoring->slik_status }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-500 block">Riwayat Tunggakan:</span>
                                <span class="font-bold text-slate-800 mt-1 block">0 Hari (Nihil)</span>
                            </div>
                            <div>
                                <span class="text-slate-500 block">Status DHN OJK:</span>
                                <span class="font-bold text-emerald-700 mt-1 block">Bersih (Tidak Terdaftar)</span>
                            </div>
                        </div>
                    @else
                        <div class="my-6 py-8 rounded-xl bg-slate-50/70 border border-dashed border-slate-200 text-center flex flex-col items-center justify-center">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-500">Data belum tersedia</span>
                            <p class="text-[11px] text-slate-400 mt-1">Hasil pengecekan SLIK Debitur & Kualitas Kredit (Kolektibilitas)</p>
                        </div>
                    @endif

                    <div class="text-xs text-slate-400 flex items-center justify-between pt-3 border-t border-slate-100">
                        <span>Status Kolektibilitas</span>
                        <span class="font-bold {{ $scoring ? 'text-emerald-700' : 'text-slate-600' }}">
                            {{ $scoring ? 'Kol 1 - Lancar Terverifikasi' : 'Belum Terverifikasi' }}
                        </span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Certificate Preview Modal (Bab 3.3 SRI) -->
        <div x-show="showCertModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm">
            <div class="bg-white rounded-3xl max-w-2xl w-full p-8 border border-slate-200 shadow-2xl relative space-y-6 animate-fadeIn">
                <!-- Close Button -->
                <button type="button" @click="showCertModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="text-center space-y-2 border-b border-slate-100 pb-6">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-black text-xl mx-auto shadow-md">S</div>
                    <h3 class="text-xl font-black text-slate-900">SERTIFIKAT PEMERINGKATAN UMKM</h3>
                    <p class="text-xs text-slate-500">SME Rating Indonesia (SRI) &bull; No: <span class="font-mono font-bold text-blue-900">{{ $scoring->certificate_id ?? 'CRTYES20260001' }}</span></p>
                </div>

                <div class="p-6 rounded-2xl bg-gradient-to-br from-blue-50/50 to-indigo-50/50 border border-blue-200 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-500 uppercase">Diberikan Kepada:</span>
                        <h4 class="text-lg font-black text-slate-900 mt-0.5">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}</h4>
                        <p class="text-xs text-slate-600 mt-1">Pemilik: <strong>{{ $user->profile->full_name ?? $user->name }}</strong> &bull; NIK: {{ $user->profile->id_card_number ?? '3171012345670001' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-4xl font-black text-blue-900">{{ $scoring->rating_grade ?? 'Bb' }}</span>
                        <span class="text-xs font-bold text-blue-700 block">Skor: {{ $scoring->credit_score ?? '740' }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">5C Total</span>
                        <strong class="text-slate-800 text-sm">75.00</strong>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">4P Total</span>
                        <strong class="text-slate-800 text-sm">79.58</strong>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">Karakter</span>
                        <strong class="text-slate-800 text-sm">82.00%</strong>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block text-[10px]">SLIK OJK</span>
                        <strong class="text-emerald-700 text-sm">Kol 1</strong>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="showCertModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Tutup
                    </button>
                    <button type="button" onclick="alert('Sertifikat Rating PDF berhasil diunduh.');" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-md">
                        Download PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- Application Submission Modal (Step 5 & 6 SRI) -->
        <div x-show="showApplyModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm">
            <div class="bg-white rounded-3xl max-w-xl w-full p-8 border border-slate-200 shadow-2xl relative space-y-6 animate-fadeIn">
                <button type="button" @click="showApplyModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div>
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Tahap 5 & 6 SRI</span>
                    <h3 class="text-xl font-black text-slate-900 mt-1">Pengajuan Fasilitas: <span class="capitalize" x-text="applyType.replace('_', ' ')"></span></h3>
                    <p class="text-xs text-slate-500">Pilih mitra lembaga keuangan / penjaminan terhubung dengan rating Anda ({{ $scoring->rating_grade ?? 'Bb' }}).</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Plafon Diajukan (Rp)</label>
                        <input type="number" x-model="loanAmount" class="w-full rounded-xl border-slate-200 text-xs text-slate-900">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Pilih Mitra Lembaga Keuangan</label>
                        <select class="w-full rounded-xl border-slate-200 text-xs text-slate-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition">
                            @foreach($partners as $partner)
                                @php
                                    $tracksJson = json_encode($partner->supported_tracks ?? []);
                                @endphp
                                <option value="{{ $partner->id }}" 
                                        x-show="{{ $tracksJson }}.includes(applyType)"
                                        :disabled="!{{ $tracksJson }}.includes(applyType)">
                                    {{ $partner->code }} - {{ \Illuminate\Support\Str::limit($partner->description, 35) }} (Bunga: {{ $partner->interest_rate_min }}% - {{ $partner->interest_rate_max }}%)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tenor Pembiayaan</label>
                        <select x-model="loanTenor" class="w-full rounded-xl border-slate-200 text-xs text-slate-900">
                            <option value="12">12 Bulan (1 Tahun)</option>
                            <option value="24">24 Bulan (2 Tahun)</option>
                            <option value="36" selected>36 Bulan (3 Tahun)</option>
                            <option value="48">48 Bulan (4 Tahun)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="showApplyModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="button" @click="submitApplication()" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-md">
                        Konfirmasi & Kirim Pengajuan &rarr;
                    </button>
                </div>
            </div>
        </div>

    </div>

    @if($scoring)
        <!-- Dashboard Live Chart.js Initialization -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // 1. Mini 4P Bar Chart
                const ctx4P = document.getElementById('dashboardChart4P');
                if (ctx4P) {
                    new Chart(ctx4P, {
                        type: 'bar',
                        data: {
                            labels: ['Pers.', 'Purp.', 'Prod.', 'Pay.'],
                            datasets: [{
                                label: 'Skor 4P',
                                data: [
                                    {{ $scoring->score_4p_personality }},
                                    {{ $scoring->score_4p_prospek }},
                                    {{ $scoring->score_4p_produktivitas }},
                                    {{ $scoring->score_4p_payment }}
                                ],
                                backgroundColor: [
                                    'rgba(37, 99, 235, 0.85)',
                                    'rgba(59, 130, 246, 0.85)',
                                    'rgba(99, 102, 241, 0.85)',
                                    'rgba(16, 185, 129, 0.85)'
                                ],
                                borderRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: (c) => ' Nilai: ' + c.raw + ' pts'
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 35,
                                    ticks: { font: { size: 9 } },
                                    grid: { color: '#F8FAFC' }
                                },
                                x: {
                                    ticks: { font: { size: 9, weight: 'bold' } },
                                    grid: { display: false }
                                }
                            }
                        }
                    });
                }

                // 2. Mini Big-Five Radar Chart
                const ctxRadar = document.getElementById('dashboardChartRadar');
                if (ctxRadar) {
                    new Chart(ctxRadar, {
                        type: 'radar',
                        data: {
                            labels: ['Open', 'Consc', 'Extra', 'Agree', 'Stab'],
                            datasets: [{
                                data: [
                                    {{ $scoring->big5_openness }},
                                    {{ $scoring->big5_conscientiousness }},
                                    {{ $scoring->big5_extraversion }},
                                    {{ $scoring->big5_agreeableness }},
                                    {{ $scoring->big5_neuroticism }}
                                ],
                                fill: true,
                                backgroundColor: 'rgba(147, 51, 234, 0.25)',
                                borderColor: '#9333EA',
                                pointBackgroundColor: '#7E22CE',
                                borderWidth: 1.5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                r: {
                                    angleLines: { color: '#E2E8F0' },
                                    grid: { color: '#F1F5F9' },
                                    pointLabels: {
                                        font: { size: 8, weight: '600' },
                                        color: '#64748B'
                                    },
                                    suggestedMin: 0,
                                    suggestedMax: 100,
                                    ticks: { display: false }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endif
</x-app-layout>
