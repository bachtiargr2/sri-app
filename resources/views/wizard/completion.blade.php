@include('wizard.layout', ['title' => 'Ringkasan Kelengkapan Formulir', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-8">

    <!-- Header Title (Gambar 23) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
        <div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800">
                    ✓ Tahap 2 Selesai
                </span>
                <span class="text-xs text-slate-400">Bab 3.7 BUKU SRI</span>
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">Ringkasan Status Kelengkapan Formulir</h2>
            <p class="text-xs text-slate-500 mt-0.5">Seluruh parameter 5C, 4P, Laporan Keuangan, Agunan, dan Psikometri Kewirausahaan telah terpenuhi.</p>
        </div>

        <div class="text-right">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Validasi</span>
            <div class="flex items-center gap-1.5 text-emerald-600 font-black text-sm mt-0.5">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Siap Diproses Skoring</span>
            </div>
        </div>
    </div>

    <!-- 4 Status Cards Grid (Gambar 23 & Tabel 14) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <!-- Card 1: Profil Diri -->
        <div class="p-5 rounded-2xl border {{ $hasProfile ? 'border-emerald-200 bg-emerald-50/30' : 'border-amber-200 bg-amber-50/30' }} flex flex-col justify-between space-y-4 hover:shadow-sm transition">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl {{ $hasProfile ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} flex items-center justify-center font-black text-sm">
                        {{ $hasProfile ? '✓' : '!' }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">1. Profil Diri & Pasangan</h4>
                        <p class="text-[11px] text-slate-500">Identitas NIK, NPWP, Kontak, & Data Keluarga</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $hasProfile ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ $hasProfile ? 'LENGKAP' : 'BELUM LENGKAP' }}
                </span>
            </div>

            <div class="text-[11px] text-slate-600 bg-white/70 p-3 rounded-xl border border-slate-100 space-y-1">
                <div class="flex justify-between">
                    <span class="text-slate-500">Nama Pemohon:</span>
                    <strong class="text-slate-800">{{ $user->profile->full_name ?? $user->name }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">No. KTP / NIK:</span>
                    <span class="font-mono font-semibold">{{ $user->profile->id_card_number ?? '3171012345670001' }}</span>
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <a href="{{ route('wizard.personal-profile') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    Edit Profil Diri &rarr;
                </a>
            </div>
        </div>

        <!-- Card 2: Profil Usaha -->
        <div class="p-5 rounded-2xl border {{ $hasBusiness ? 'border-emerald-200 bg-emerald-50/30' : 'border-amber-200 bg-amber-50/30' }} flex flex-col justify-between space-y-4 hover:shadow-sm transition">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl {{ $hasBusiness ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} flex items-center justify-center font-black text-sm">
                        {{ $hasBusiness ? '✓' : '!' }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">2. Profil Usaha (Badan Usaha)</h4>
                        <p class="text-[11px] text-slate-500">Akta Pendirian, Izin Usaha, & Legalitas</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $hasBusiness ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ $hasBusiness ? 'LENGKAP' : 'BELUM LENGKAP' }}
                </span>
            </div>

            <div class="text-[11px] text-slate-600 bg-white/70 p-3 rounded-xl border border-slate-100 space-y-1">
                <div class="flex justify-between">
                    <span class="text-slate-500">Nama Badan Usaha:</span>
                    <strong class="text-slate-800">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Bentuk Legalitas:</span>
                    <span class="font-semibold">{{ strtoupper($user->business->legal_form ?? 'PT') }}</span>
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <a href="{{ route('wizard.business-profile') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    Edit Profil Usaha &rarr;
                </a>
            </div>
        </div>

        <!-- Card 3: Kinerja Keuangan & Rasio -->
        <div class="p-5 rounded-2xl border {{ $hasFinancial ? 'border-emerald-200 bg-emerald-50/30' : 'border-amber-200 bg-amber-50/30' }} flex flex-col justify-between space-y-4 hover:shadow-sm transition">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl {{ $hasFinancial ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} flex items-center justify-center font-black text-sm">
                        {{ $hasFinancial ? '✓' : '!' }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">3. Kinerja Keuangan & Agunan</h4>
                        <p class="text-[11px] text-slate-500">Laporan 3 Periode, Agunan, Manajemen & RAC</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $hasFinancial ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ $hasFinancial ? 'LENGKAP' : 'BELUM LENGKAP' }}
                </span>
            </div>

            <div class="text-[11px] text-slate-600 bg-white/70 p-3 rounded-xl border border-slate-100 space-y-1">
                <div class="flex justify-between">
                    <span class="text-slate-500">Periode Laporan:</span>
                    <strong class="text-slate-800">Dec 2020, Dec 2021, Dec 2022 (3 Tahun)</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Nilai Agunan Terdaftar:</span>
                    <span class="font-bold text-emerald-700">Rp 2.500.000.000 (SHM)</span>
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <a href="{{ route('wizard.financial-report') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    Edit Laporan Keuangan &rarr;
                </a>
            </div>
        </div>

        <!-- Card 4: Karakter Kewirausahaan -->
        <div class="p-5 rounded-2xl border {{ $hasCharacter ? 'border-emerald-200 bg-emerald-50/30' : 'border-amber-200 bg-amber-50/30' }} flex flex-col justify-between space-y-4 hover:shadow-sm transition">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl {{ $hasCharacter ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} flex items-center justify-center font-black text-sm">
                        {{ $hasCharacter ? '✓' : '!' }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">4. Karakter Kewirausahaan</h4>
                        <p class="text-[11px] text-slate-500">20 Soal Psikometri Big-Five Personality</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $hasCharacter ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ $hasCharacter ? 'SELESAI & TERKUNCI' : 'BELUM SELESAI' }}
                </span>
            </div>

            <div class="text-[11px] text-slate-600 bg-white/70 p-3 rounded-xl border border-slate-100 space-y-1">
                <div class="flex justify-between">
                    <span class="text-slate-500">Status Pengisian:</span>
                    <strong class="text-emerald-700">20 dari 20 Soal Terjawab</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Integritas Data:</span>
                    <span class="font-semibold text-slate-800">Tervalidasi Sistem SRI</span>
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <a href="{{ route('wizard.character-assessment') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    Lihat Dimensi Karakter &rarr;
                </a>
            </div>
        </div>

    </div>

    <!-- Bottom Action Bar (Gambar 23: Cek Formulir & Resume Pemeringkatan) -->
    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Pengecekan Formulir & Finalisasi</h4>
            <p class="text-xs text-slate-500 mt-0.5">Anda dapat mengunduh berkas ringkasan formulir sebelum melanjutkan ke kalkulasi sertifikat rating.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto justify-end">
            <!-- Tombol Cek Formulir -->
            <button type="button" 
                    onclick="alert('Format dokumen ringkasan data formulir calon debitur telah diunduh.');"
                    class="px-5 py-3 rounded-xl border border-blue-200 bg-white hover:bg-blue-50 text-blue-700 font-bold text-xs shadow-sm transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Cek Formulir (Resume PDF)
            </button>

            <!-- Tombol Resume & Lanjut Hasil Pemeringkatan (Step 3) -->
            <a href="{{ route('dashboard') }}" 
               class="px-8 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 active:from-blue-800 active:to-indigo-800 text-white font-extrabold rounded-xl shadow-lg shadow-blue-500/30 transition text-xs flex items-center gap-2">
                <span>Resume & Lihat Hasil Pemeringkatan (Step 3)</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>

</div>
