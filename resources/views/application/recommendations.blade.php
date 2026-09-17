<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Breadcrumb Header (Tahap 4 & 6) -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-blue-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Tahap 4 & 6: Rekomendasi & Kolaborasi Mitra</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Rekomendasi Kesesuaian Mitra Lembaga Keuangan</h1>
                    <p class="text-xs text-slate-500 mt-1">Sistem matching SRI telah menyaring produk perbankan dan penjaminan yang paling optimal untuk profil risiko dan rating usaha Anda.</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('apply.choose') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/25 transition flex items-center gap-2">
                        <span>Pilihan Jalur Pengajuan &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Debtor Rating Context Callout -->
            <div class="rounded-3xl bg-gradient-to-br from-[#1E40AF] via-blue-800 to-indigo-950 p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-400/20 text-emerald-300 border border-emerald-400/30">
                            Peringkat Debitur: {{ $scoring->rating_grade }} (Skor {{ $scoring->credit_score }})
                        </span>
                        <span class="text-xs text-blue-200">SLIK: <strong>{{ $scoring->slik_status }}</strong></span>
                    </div>
                    <h2 class="text-xl font-black text-white">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}</h2>
                    <p class="text-xs text-blue-100/90 max-w-2xl leading-relaxed">
                        Dengan skor 740 dan kategori risiko rendah, seluruh lembaga keuangan berikut telah mengaktifkan jalur approval cepat (Fast-Track Underwriting) untuk pengajuan modal kerja Anda.
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20 text-center shrink-0">
                    <span class="text-[10px] uppercase font-bold text-blue-200 block">Kecocokan Profil</span>
                    <span class="text-3xl font-black text-emerald-300 block">98.5%</span>
                    <span class="text-[10px] text-blue-100">Optimal RAC Met</span>
                </div>
            </div>

            <!-- Recommended Partners Grid (Gambar 39 & Bab 6) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($partners as $p)
                    <div class="bg-white rounded-3xl p-6 border-2 border-slate-200 hover:border-blue-500 shadow-sm hover:shadow-xl transition flex flex-col justify-between space-y-5 group">
                        
                        <div class="space-y-4">
                            <!-- Card Header -->
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-900 font-black text-sm flex items-center justify-center border border-blue-100 group-hover:scale-105 transition shadow-sm">
                                        {{ substr($p->code, 0, 3) }}
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-slate-900">{{ $p->name }}</h3>
                                        <span class="text-[10px] font-bold text-blue-600 uppercase">{{ $p->category }}</span>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    Cocok 95%+
                                </span>
                            </div>

                            <p class="text-xs text-slate-500 leading-relaxed">
                                {{ $p->description }}
                            </p>

                            <!-- Facility Details Table -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Estimasi Suku Bunga / Fee:</span>
                                    <strong class="text-blue-900 font-bold">{{ $p->interest_rate_min }}% - {{ $p->interest_rate_max }}%</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Maks Tenor:</span>
                                    <strong class="text-slate-800">{{ $p->max_tenor_months ?? 60 }} Bulan</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Maksimal Plafon:</span>
                                    <strong class="text-slate-800">Rp {{ number_format($p->max_plafon ?? 5000000000, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2 pt-2 border-t border-slate-100">
                            @if(in_array('kredit', $p->supported_tracks ?? []))
                                <a href="{{ route('apply.kredit') }}" class="w-full py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs text-center shadow-md transition flex items-center justify-center gap-1.5">
                                    <span>Ajukan Kredit ke {{ $p->code }}</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @endif

                            @if(in_array('cash_loan', $p->supported_tracks ?? []))
                                <a href="{{ route('apply.cash_loan') }}" class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs text-center shadow-md transition flex items-center justify-center gap-1.5">
                                    <span>Ajukan Penjaminan Cash Loan</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @endif

                            @if(in_array('non_cash_loan', $p->supported_tracks ?? []))
                                <a href="{{ route('apply.non_cash_loan') }}" class="w-full py-2.5 px-4 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs text-center shadow-md transition flex items-center justify-center gap-1.5">
                                    <span>Ajukan Non-Cash Loan / BG</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
