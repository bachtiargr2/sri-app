<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Stepper Navigation Header (Tahap 5) -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-blue-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Tahap 5 SRI: Pilihan Pengajuan Track</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Pilih Jalur Fasilitas Pembiayaan UMKM</h1>
                    <p class="text-xs text-slate-500 mt-1">Pilih salah satu dari 3 opsi fasilitas perbankan dan penjaminan yang sesuai dengan kebutuhan modal kerja atau proyek Anda.</p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="px-3 py-1.5 rounded-full text-xs font-black bg-blue-50 text-blue-800 border border-blue-200">
                        Rating Aktif: {{ $scoring->rating_grade }} ({{ $scoring->credit_score }})
                    </span>
                </div>
            </div>

            <!-- 3 Track Option Cards (Bab 4 SRI) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Track 1: Kredit Perbankan (Bab 4.1) -->
                <div class="bg-white rounded-3xl p-8 border-2 border-slate-200 hover:border-blue-600 shadow-sm hover:shadow-xl transition flex flex-col justify-between space-y-6 group">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 group-hover:bg-blue-600 text-blue-600 group-hover:text-white flex items-center justify-center transition shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-200">Jalur 1</span>
                            <h3 class="text-xl font-black text-slate-900 mt-2">Kredit Perbankan (Bank Loan)</h3>
                            <p class="text-xs text-slate-500 mt-1">Fasilitas Kredit Usaha Rakyat (KUR) dan Kredit Modal Kerja / Investasi komersial dari mitra Bank BUMN & Bank Swasta nasional.</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Estimasi Bunga:</span>
                                <strong class="text-blue-900 font-bold">1.00% - 5.00% / bulan</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Maksimal Tenor:</span>
                                <strong class="text-slate-800">Hingga 60 Bulan (5 Thn)</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Kesesuaian Agunan:</span>
                                <strong class="text-emerald-700 font-bold">166% (Terpenuhi)</strong>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('apply.kredit') }}" class="w-full py-3.5 px-6 rounded-xl bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold text-xs text-center shadow-lg shadow-blue-500/25 transition">
                        Ajukan Fasilitas Kredit &rarr;
                    </a>
                </div>

                <!-- Track 2: Penjaminan Cash Loan (Bab 4.2) -->
                <div class="bg-white rounded-3xl p-8 border-2 border-slate-200 hover:border-emerald-600 shadow-sm hover:shadow-xl transition flex flex-col justify-between space-y-6 group">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 group-hover:bg-emerald-600 text-emerald-600 group-hover:text-white flex items-center justify-center transition shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">Jalur 2</span>
                            <h3 class="text-xl font-black text-slate-900 mt-2">Penjaminan Cash Loan</h3>
                            <p class="text-xs text-slate-500 mt-1">Layanan penjaminan pinjaman modal kerja dan pembiayaan multiguna dari Lembaga Penjaminan Kredit (Jamkrindo, Jamkrindo Syariah, Jamkrida).</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Fee Penjaminan:</span>
                                <strong class="text-emerald-900 font-bold">0.50% - 2.00% / thn</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Maksimal Plafon:</span>
                                <strong class="text-slate-800">Hingga Rp 25 Miliar</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Coverage Penjaminan:</span>
                                <strong class="text-emerald-700 font-bold">70% - 80% Pinjaman</strong>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('apply.cash_loan') }}" class="w-full py-3.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold text-xs text-center shadow-lg shadow-emerald-500/25 transition">
                        Ajukan Penjaminan Cash Loan &rarr;
                    </a>
                </div>

                <!-- Track 3: Penjaminan Non-Cash Loan (Bab 4.3) -->
                <div class="bg-white rounded-3xl p-8 border-2 border-slate-200 hover:border-purple-600 shadow-sm hover:shadow-xl transition flex flex-col justify-between space-y-6 group">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-purple-50 group-hover:bg-purple-600 text-purple-600 group-hover:text-white flex items-center justify-center transition shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-purple-600 bg-purple-50 px-2.5 py-1 rounded-full border border-purple-200">Jalur 3</span>
                            <h3 class="text-xl font-black text-slate-900 mt-2">Penjaminan Non-Cash Loan</h3>
                            <p class="text-xs text-slate-500 mt-1">Fasilitas penerbitan Bank Garansi, Kontra Garansi, Surety Bond (Jaminan Penawaran, Pelaksanaan, Uang Muka, Pemeliharaan) untuk proyek pengadaan.</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Instrumen:</span>
                                <strong class="text-purple-900 font-bold">Surety Bond & BG Proyek</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Proses Approval:</span>
                                <strong class="text-slate-800">Express (1-2 Hari Kerja)</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Tanpa Agunan Tunai:</span>
                                <strong class="text-emerald-700 font-bold">Didukung Rating Bb SRI</strong>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('apply.non_cash_loan') }}" class="w-full py-3.5 px-6 rounded-xl bg-purple-600 hover:bg-purple-700 active:bg-purple-800 text-white font-bold text-xs text-center shadow-lg shadow-purple-500/25 transition">
                        Ajukan Non-Cash Loan &rarr;
                    </a>
                </div>

            </div>

            <!-- Recommendations Link Callout -->
            <div class="p-6 rounded-2xl bg-blue-50/70 border border-blue-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-sm shrink-0">
                        SRI
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Ingin melihat rekomendasi mitra pembiayaan yang paling cocok dengan profil Anda?</h4>
                        <p class="text-[11px] text-slate-500">Sistem SRI telah mencocokkan profil risiko dan rating Anda ke lembaga keuangan mitra.</p>
                    </div>
                </div>
                <a href="{{ route('apply.recommendations') }}" class="px-5 py-2.5 rounded-xl border border-blue-200 bg-white hover:bg-blue-50 text-blue-700 font-bold text-xs shadow-sm transition">
                    Lihat Rekomendasi Mitra (Tahap 4 & 6) &rarr;
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
