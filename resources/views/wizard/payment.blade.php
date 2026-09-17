@include('wizard.layout', ['title' => 'Payment, DSR & RAC', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Top Sub-Navigation Tabs matching Gambar 18 -->
    <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-slate-200">
        <a href="{{ route('wizard.financial-report') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Laporan Keuangan
        </a>
        <a href="{{ route('wizard.collateral') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Data Agunan
        </a>
        <a href="{{ route('wizard.management') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Profil Manajemen
        </a>
        <a href="{{ route('wizard.prospect') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Prospek
        </a>
        <a href="{{ route('wizard.productivity') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Produktivitas
        </a>
        <a href="{{ route('wizard.payment') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm">
            &bull; Payment & RAC
        </a>
    </div>

    <!-- Header Title -->
    <div>
        <h2 class="text-xl font-bold text-slate-900">Payment, DSR & Kriteria Akseptasi Risiko (RAC)</h2>
        <p class="text-xs text-slate-500 mt-1">Verifikasi kemampuan pembayaran angsuran kredit serta pemenuhan batas kriteria risiko mitra lembaga keuangan.</p>
    </div>

    <!-- Payment / DSR Overview Box (Gambar 18) -->
    <div class="p-6 rounded-2xl bg-blue-50/50 border border-blue-100 space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <span class="text-[11px] font-bold text-blue-900 uppercase tracking-wider">Proyeksi Debt Service Ratio (DSR)</span>
                <p class="text-xs text-slate-600 mt-0.5">Persentase angsuran pokok dan bunga terhadap estimasi laba bersih operasional.</p>
            </div>
            <div class="text-left sm:text-right">
                <span class="text-2xl font-black text-blue-900">28.50%</span>
                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                    Aman (&lt; 40%)
                </span>
            </div>
        </div>

        <div class="w-full bg-slate-200 rounded-full h-2">
            <div class="bg-emerald-500 h-2 rounded-full" style="width: 28.5%"></div>
        </div>
        <p class="text-[11px] text-slate-500">Estimasi kapasitas angsuran debitur berada pada zona aman dengan ketahanan kas yang memadai.</p>
    </div>

    <!-- Risk Acceptance Criteria (RAC) Checklist (Tabel 11 & Gambar 18) -->
    <div class="space-y-4 pt-2">
        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Kesesuaian Kriteria Akseptasi Risiko (RAC Minimum):</h3>

        <div class="divide-y divide-slate-100 border border-slate-200 rounded-2xl overflow-hidden bg-white">
            
            <!-- RAC 1: Bentuk Badan Usaha -->
            <div class="p-4 flex items-center justify-between hover:bg-slate-50/50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                        ✓
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Bentuk Badan Usaha Legal</p>
                        <p class="text-[11px] text-slate-500">Terdaftar sebagai PT (Perseroan Terbatas) dengan SK Kemenkumham</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Memenuhi Syarat
                </span>
            </div>

            <!-- RAC 2: Usia Pemilik / Direktur -->
            <div class="p-4 flex items-center justify-between hover:bg-slate-50/50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                        ✓
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Usia Pemohon / Direktur Utama</p>
                        <p class="text-[11px] text-slate-500">40 Tahun (Batas persyaratan bank: 21 s.d 65 tahun pada saat kredit jatuh tempo)</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Memenuhi Syarat
                </span>
            </div>

            <!-- RAC 3: Lama Berdiri Usaha -->
            <div class="p-4 flex items-center justify-between hover:bg-slate-50/50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                        ✓
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Lama Operasional Usaha</p>
                        <p class="text-[11px] text-slate-500">10 Tahun beroperasi aktif (Minimal persyaratan: 2 tahun usaha kontinu)</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Memenuhi Syarat
                </span>
            </div>

            <!-- RAC 4: Kecukupan Agunan -->
            <div class="p-4 flex items-center justify-between hover:bg-slate-50/50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                        ✓
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Legalitas & Kecukupan Nilai Agunan</p>
                        <p class="text-[11px] text-slate-500">Agunan SHM Bersertifikat Resmi dengan coverage &ge; 120% terhadap plafon pengajuan</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Memenuhi Syarat
                </span>
            </div>

            <!-- RAC 5: SLIK OJK & DHN -->
            <div class="p-4 flex items-center justify-between hover:bg-slate-50/50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                        ✓
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Riwayat Kredit SLIK OJK & Daftar Hitam Nasional (DHN)</p>
                        <p class="text-[11px] text-slate-500">Kolektibilitas 1 (Lancar) & Tidak tercatat dalam Daftar Hitam Nasional BI</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Kolektibilitas Lancar
                </span>
            </div>

        </div>
    </div>

    <!-- Navigation Form -->
    <form method="POST" action="{{ route('wizard.save-payment') }}" class="pt-4">
        @csrf
        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
            <a href="{{ route('wizard.productivity') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                &larr; Produktivitas & Rasio
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                Simpan & Lanjutkan ke Asesmen Karakter Kewirausahaan &rarr;
            </button>
        </div>
    </form>
</div>
