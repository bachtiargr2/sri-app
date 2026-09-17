@include('wizard.layout', ['title' => 'Produktivitas & Rasio Keuangan', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Top Sub-Navigation Tabs matching Gambar 17 -->
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
        <a href="{{ route('wizard.productivity') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm">
            &bull; Produktivitas
        </a>
        <a href="{{ route('wizard.payment') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Payment & RAC
        </a>
    </div>

    <!-- Header Title -->
    <div>
        <h2 class="text-xl font-bold text-slate-900">Produktivitas & Analisis Rasio Keuangan</h2>
        <p class="text-xs text-slate-500 mt-1">Kalkulasi otomatis rasio modal, solvabilitas, profitabilitas, dan likuiditas berdasarkan Laporan Keuangan 3 Periode.</p>
    </div>

    <!-- Ratio Cards Grid (Gambar 17 & Tabel 10) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 pt-2">
        
        <!-- 1. CAR (Capital Adequacy Ratio) -->
        <div class="p-5 rounded-2xl bg-gradient-to-br from-blue-50/60 to-white border border-blue-100 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-blue-900 uppercase tracking-wider">CAR (Modal Sendiri / Aset)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">
                    {{ $car >= 15 ? 'Memenuhi' : 'Waspada' }}
                </span>
            </div>
            <div class="mt-3">
                <span class="text-2xl font-black text-blue-900">{{ number_format($car, 2) }}%</span>
                <p class="text-[11px] text-slate-500 mt-1">Standar Acuan: <strong class="text-slate-700">&gt; 15.00%</strong></p>
            </div>
            <div class="w-full bg-slate-200/80 rounded-full h-1.5 mt-3">
                <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ min(100, $car * 2) }}%"></div>
            </div>
        </div>

        <!-- 2. DER (Debt to Equity Ratio) -->
        <div class="p-5 rounded-2xl bg-gradient-to-br from-blue-50/60 to-white border border-blue-100 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-blue-900 uppercase tracking-wider">DER (Leverage / Utang)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">
                    {{ $der <= 1.2 ? 'Sehat' : 'Tinggi' }}
                </span>
            </div>
            <div class="mt-3">
                <span class="text-2xl font-black text-blue-900">{{ number_format($der, 2) }}x</span>
                <p class="text-[11px] text-slate-500 mt-1">Standar Acuan: <strong class="text-slate-700">&le; 1.20x</strong></p>
            </div>
            <div class="w-full bg-slate-200/80 rounded-full h-1.5 mt-3">
                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ min(100, (1.2 / max(0.1, $der)) * 50) }}%"></div>
            </div>
        </div>

        <!-- 3. ROA (Return on Assets) -->
        <div class="p-5 rounded-2xl bg-gradient-to-br from-blue-50/60 to-white border border-blue-100 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-blue-900 uppercase tracking-wider">ROA (Profitabilitas Aset)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">
                    {{ $roa >= 1.5 ? 'Sangat Baik' : 'Cukup' }}
                </span>
            </div>
            <div class="mt-3">
                <span class="text-2xl font-black text-blue-900">{{ number_format($roa, 2) }}%</span>
                <p class="text-[11px] text-slate-500 mt-1">Standar Acuan: <strong class="text-slate-700">&gt; 1.50%</strong></p>
            </div>
            <div class="w-full bg-slate-200/80 rounded-full h-1.5 mt-3">
                <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ min(100, $roa * 3) }}%"></div>
            </div>
        </div>

        <!-- 4. ROE (Return on Equity) -->
        <div class="p-5 rounded-2xl bg-gradient-to-br from-blue-50/60 to-white border border-blue-100 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-blue-900 uppercase tracking-wider">ROE (Return on Equity)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">
                    {{ $roe >= 20 ? 'Optimal' : 'Cukup' }}
                </span>
            </div>
            <div class="mt-3">
                <span class="text-2xl font-black text-blue-900">{{ number_format($roe, 2) }}%</span>
                <p class="text-[11px] text-slate-500 mt-1">Standar Acuan: <strong class="text-slate-700">&gt; 20.00%</strong></p>
            </div>
            <div class="w-full bg-slate-200/80 rounded-full h-1.5 mt-3">
                <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ min(100, $roe * 2.5) }}%"></div>
            </div>
        </div>

        <!-- 5. Cash Ratio -->
        <div class="p-5 rounded-2xl bg-gradient-to-br from-blue-50/60 to-white border border-blue-100 shadow-sm relative overflow-hidden sm:col-span-2 lg:col-span-2">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-blue-900 uppercase tracking-wider">Cash Ratio (Kas / Kewajiban Lancar)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">
                    {{ $cashRatio >= 25 ? 'Likuid & Terjaga' : 'Perlu Tambahan Kas' }}
                </span>
            </div>
            <div class="mt-3 flex items-baseline gap-4">
                <span class="text-2xl font-black text-blue-900">{{ number_format($cashRatio, 2) }}%</span>
                <p class="text-[11px] text-slate-500">Kecukupan kas likuid siap pakai memenuhi kewajiban jangka pendek. Standar acuan: <strong class="text-slate-700">&gt; 25.00%</strong></p>
            </div>
            <div class="w-full bg-slate-200/80 rounded-full h-1.5 mt-3">
                <div class="bg-emerald-600 h-1.5 rounded-full" style="width: {{ min(100, $cashRatio * 2) }}%"></div>
            </div>
        </div>

    </div>

    <!-- Summary Notice -->
    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p>Seluruh indikator rasio produktivitas dihitung otomatis dari rekonsiliasi data Laporan Laba Rugi dan Neraca periode terakhir. Anda dapat melanjutkan ke verifikasi kemampuan bayar (Payment) dan kriteria akseptasi risiko (RAC).</p>
    </div>

    <!-- Form Navigation Buttons -->
    <form method="POST" action="{{ route('wizard.save-productivity') }}" class="pt-4">
        @csrf
        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
            <a href="{{ route('wizard.prospect') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                &larr; Prospek Bisnis
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                Simpan & Lanjutkan ke Payment & RAC &rarr;
            </button>
        </div>
    </form>
</div>
