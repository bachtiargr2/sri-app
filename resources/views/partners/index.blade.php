<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Breadcrumb & Header (Bab 5 SRI) -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-blue-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Bab 5: Direktori Mitra & Afiliasi</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Direktori Lembaga Keuangan & Mitra Penjaminan</h1>
                    <p class="text-xs text-slate-500 mt-1">Daftar lengkap institusi perbankan, LK non-bank, dan lembaga penjaminan resmi yang terintegrasi dengan ekosistem SME Rating Indonesia (SRI).</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('apply.choose') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/25 transition flex items-center gap-2">
                        <span>Pilihan Jalur Pengajuan &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Search & Filters Toolbar (Gambar 39 - 41) -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-5">
                <form method="GET" action="{{ route('partners.index') }}" class="space-y-4">
                    
                    <!-- Search Input & Quick Track Dropdown -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-8 relative">
                            <input type="text" 
                                   name="q" 
                                   value="{{ $query }}" 
                                   placeholder="Cari nama bank, lembaga penjaminan, atau kata kunci fasilitas..." 
                                   class="w-full rounded-2xl border-slate-200 bg-slate-50/50 pl-11 pr-4 py-3 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        <div class="md:col-span-4 flex items-center gap-2">
                            <select name="track" class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                                <option value="all" {{ ($track == 'all' || !$track) ? 'selected' : '' }}>Semua Jalur Fasilitas</option>
                                <option value="kredit" {{ $track == 'kredit' ? 'selected' : '' }}>Kredit Perbankan</option>
                                <option value="cash_loan" {{ $track == 'cash_loan' ? 'selected' : '' }}>Penjaminan Cash Loan</option>
                                <option value="non_cash_loan" {{ $track == 'non_cash_loan' ? 'selected' : '' }}>Penjaminan Non-Cash Loan</option>
                            </select>

                            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-2xl shadow-sm transition">
                                Cari
                            </button>
                        </div>
                    </div>

                    <!-- Category Tabs (Gambar 40) -->
                    <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-100">
                        @foreach($categories as $key => $label)
                            <a href="{{ route('partners.index', ['category' => $key, 'track' => $track, 'q' => $query]) }}" 
                               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ ($category == $key || (!$category && $key == 'all')) ? 'bg-blue-600 text-white shadow-sm' : 'bg-slate-100 hover:bg-slate-200 text-slate-700' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </form>
            </div>

            <!-- Partners Cards Catalog Grid -->
            @if($partners->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($partners as $p)
                        <div class="bg-white rounded-3xl p-6 border-2 border-slate-200 hover:border-blue-500 shadow-sm hover:shadow-xl transition flex flex-col justify-between space-y-5 group">
                            
                            <div class="space-y-4">
                                <!-- Card Header -->
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 text-blue-900 font-black text-sm flex items-center justify-center border border-blue-200/60 shadow-sm group-hover:scale-105 transition">
                                            {{ substr($p->code, 0, 4) }}
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-slate-900">{{ $p->name }}</h3>
                                            <span class="text-[10px] font-bold text-blue-600 uppercase">{{ $p->category }}</span>
                                        </div>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Mitra Resmi
                                    </span>
                                </div>

                                <p class="text-xs text-slate-500 leading-relaxed min-h-[48px]">
                                    {{ $p->description }}
                                </p>

                                <!-- Supported Tracks Badges -->
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    @if(in_array('kredit', $p->supported_tracks ?? []))
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-200">
                                            Kredit Bank
                                        </span>
                                    @endif
                                    @if(in_array('cash_loan', $p->supported_tracks ?? []))
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Cash Loan
                                        </span>
                                    @endif
                                    @if(in_array('non_cash_loan', $p->supported_tracks ?? []))
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-purple-50 text-purple-700 border border-purple-200">
                                            Non-Cash Loan
                                        </span>
                                    @endif
                                </div>

                                <!-- Financial Terms Box -->
                                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2 text-xs">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Estimasi Suku Bunga / Fee:</span>
                                        <strong class="text-blue-900 font-bold">{{ $p->interest_rate_min }}% - {{ $p->interest_rate_max }}%</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Maksimal Tenor:</span>
                                        <strong class="text-slate-800">{{ $p->max_tenor_months ?? 60 }} Bulan</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Maksimal Plafon:</span>
                                        <strong class="text-slate-800">Rp {{ number_format($p->max_plafon ?? 5000000000, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Contact & Action Buttons -->
                            <div class="space-y-3 pt-2 border-t border-slate-100">
                                <div class="flex items-center justify-between text-[11px] text-slate-500">
                                    <span>Call Center: <strong class="text-slate-700">{{ $p->contact_phone }}</strong></span>
                                    <a href="{{ $p->website }}" target="_blank" class="text-blue-600 hover:underline">Website &rarr;</a>
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <a href="{{ route('apply.choose') }}" class="py-2.5 px-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs text-center shadow-sm transition">
                                        Ajukan Fasilitas
                                    </a>
                                    <a href="{{ route('scoring.summary') }}" class="py-2.5 px-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs text-center shadow-sm transition">
                                        Cek Kesesuaian
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-3xl p-16 text-center border border-slate-200 space-y-3">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Tidak Ditemukan Mitra</h3>
                    <p class="text-xs text-slate-500">Tidak ada mitra lembaga keuangan yang cocok dengan filter atau kata kunci pencarian Anda.</p>
                    <a href="{{ route('partners.index') }}" class="inline-block mt-2 px-5 py-2 rounded-xl bg-blue-600 text-white text-xs font-bold">
                        Reset Filter
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
