<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Breadcrumbs & Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-blue-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Ringkasan Penilaian</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Ringkasan Hasil Penilaian & Pemeringkatan UMKM</h1>
                    <p class="text-xs text-slate-500 mt-1">Evaluasi komprehensif model 4P, 5C, Karakter Kewirausahaan Big-Five, dan Kualitas Kredit SLIK OJK.</p>
                </div>

                <div class="flex items-center gap-3">
                    <form method="POST" action="{{ route('scoring.recalculate') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Hitung Ulang Skoring
                        </button>
                    </form>
                    <a href="{{ route('scoring.certificate') }}" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/25 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Lihat Sertifikat Resmi &rarr;
                    </a>
                </div>
            </div>

            <!-- Top Rating Banner Card -->
            <div class="rounded-3xl bg-gradient-to-br from-[#1E40AF] via-blue-800 to-indigo-950 p-6 sm:p-8 text-white shadow-xl relative overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    <div class="lg:col-span-8 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-400/20 text-emerald-300 border border-emerald-400/30">
                                Sertifikat Terbit: {{ $scoring->certificate_id }}
                            </span>
                            <span class="text-xs text-blue-200">Kolektibilitas: <strong>{{ $scoring->slik_status }}</strong></span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-black text-white">
                            {{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}
                        </h2>
                        <p class="text-xs sm:text-sm text-blue-100/90 leading-relaxed max-w-3xl">
                            {{ $scoring->rating_description }}
                        </p>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                            <div class="p-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                                <span class="text-[10px] uppercase font-bold text-blue-200 block">Plafon Maksimal</span>
                                <span class="text-base font-black text-white mt-0.5 block">Rp 1.500.000.000</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                                <span class="text-[10px] uppercase font-bold text-blue-200 block">Rekomendasi Tenor</span>
                                <span class="text-base font-black text-white mt-0.5 block">36 Bulan (3 Thn)</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                                <span class="text-[10px] uppercase font-bold text-blue-200 block">Taksasi Agunan</span>
                                <span class="text-base font-black text-white mt-0.5 block">Rp {{ number_format($collateralTotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15">
                                <span class="text-[10px] uppercase font-bold text-blue-200 block">Status SLIK OJK</span>
                                <span class="text-base font-black text-emerald-300 mt-0.5 block">Lancar (Kol 1)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Grade Badge -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center p-6 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-center">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-200">Rating Predikat SRI</span>
                        <span class="text-6xl font-black text-white tracking-tight my-1 drop-shadow-md">{{ $scoring->rating_grade }}</span>
                        <div class="px-4 py-1 rounded-full bg-white text-blue-900 font-black text-xs shadow-sm">
                            Skor: {{ $scoring->credit_score }} / 1000
                        </div>
                        <span class="text-[11px] text-blue-200 mt-2">Risiko Kredit Rendah</span>
                    </div>
                </div>
            </div>

            <!-- 3 Visualizations Row (Chart.js): 4P Bar, 5C Bar, Big-Five Radar -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Chart 1: Penilaian 4P (Personality, Purpose, Productivity, Payment) -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-blue-600 bg-blue-50 px-2 py-0.5 rounded">Model 4P</span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">Penilaian 4P Usaha</h3>
                        </div>
                        <span class="text-base font-black text-blue-900">{{ $scoring->score_4p_total }} <span class="text-xs font-semibold text-slate-400">/ 100</span></span>
                    </div>

                    <!-- Canvas Chart.js 4P -->
                    <div class="relative h-64 w-full">
                        <canvas id="chart4P"></canvas>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-[11px] pt-2 border-t border-slate-100">
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Personality:</span>
                            <strong class="text-slate-800">{{ $scoring->score_4p_personality }} / 25</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Purpose/Prospek:</span>
                            <strong class="text-slate-800">{{ $scoring->score_4p_prospek }} / 10</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Productivity:</span>
                            <strong class="text-slate-800">{{ $scoring->score_4p_produktivitas }} / 35</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Payment & RAC:</span>
                            <strong class="text-slate-800">{{ $scoring->score_4p_payment }} / 20</strong>
                        </div>
                    </div>
                </div>

                <!-- Chart 2: Penilaian 5C (Character, Capacity, Collateral, Capital, Condition) -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded">Prinsip 5C</span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">Penilaian 5C Kredit</h3>
                        </div>
                        <span class="text-base font-black text-indigo-900">{{ $scoring->score_5c_total }} <span class="text-xs font-semibold text-slate-400">/ 100</span></span>
                    </div>

                    <!-- Canvas Chart.js 5C -->
                    <div class="relative h-64 w-full">
                        <canvas id="chart5C"></canvas>
                    </div>

                    <div class="grid grid-cols-3 gap-2 text-[11px] pt-2 border-t border-slate-100">
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Character</span>
                            <strong class="text-slate-800">{{ $scoring->score_5c_character }}</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Capacity</span>
                            <strong class="text-slate-800">{{ $scoring->score_5c_capacity }}</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Collateral</span>
                            <strong class="text-slate-800">{{ $scoring->score_5c_collateral }}</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Capital</span>
                            <strong class="text-slate-800">{{ $scoring->score_5c_capital }}</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50 col-span-2">
                            <span class="text-slate-500 block">Condition</span>
                            <strong class="text-slate-800">{{ $scoring->score_5c_condition }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Chart 3: Psikogram Karakter Kewirausahaan Big-Five (Radar Chart) -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-purple-600 bg-purple-50 px-2 py-0.5 rounded">Big-Five Radar</span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">Psikogram Wirausaha</h3>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            ✓ 20 Soal Valid
                        </span>
                    </div>

                    <!-- Canvas Chart.js Big-Five Radar -->
                    <div class="relative h-64 w-full">
                        <canvas id="chartBigFive"></canvas>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-[11px] pt-2 border-t border-slate-100">
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Openness:</span>
                            <strong class="text-purple-700">{{ $scoring->big5_openness }}%</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Conscientious:</span>
                            <strong class="text-purple-700">{{ $scoring->big5_conscientiousness }}%</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Extraversion:</span>
                            <strong class="text-purple-700">{{ $scoring->big5_extraversion }}%</strong>
                        </div>
                        <div class="p-2 rounded-xl bg-slate-50">
                            <span class="text-slate-500 block">Stability:</span>
                            <strong class="text-purple-700">{{ $scoring->big5_neuroticism }}%</strong>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Detailed Risk & Recommendation Evaluation Matrix (Bab 3.9) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
                <div>
                    <h3 class="text-lg font-black text-slate-900">Matriks Evaluasi Kepatuhan & Kelayakan Pembiayaan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Analisis mendalam berdasarkan data historis 3 tahun dan perizinan legalitas usaha.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Column 1: Analisis Rasio Finansial -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">1. Analisis Kinerja Finansial (3 Periode)</h4>
                        <div class="divide-y divide-slate-200 text-xs">
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Capital Adequacy Ratio (CAR):</span>
                                <strong class="text-slate-900">18.50% &bull; <span class="text-emerald-600 font-bold">Memenuhi (> 15%)</span></strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Debt to Equity Ratio (DER):</span>
                                <strong class="text-slate-900">0.35x &bull; <span class="text-emerald-600 font-bold">Sangat Sehat (&le; 1.20x)</span></strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Return on Assets (ROA):</span>
                                <strong class="text-slate-900">19.30% &bull; <span class="text-emerald-600 font-bold">Sangat Baik (> 1.5%)</span></strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Return on Equity (ROE):</span>
                                <strong class="text-slate-900">24.60% &bull; <span class="text-emerald-600 font-bold">Optimal (> 20%)</span></strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Cash Ratio (Likuiditas Kas):</span>
                                <strong class="text-slate-900">38.00% &bull; <span class="text-emerald-600 font-bold">Likuid (> 25%)</span></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Legalitas & Kepatuhan RAC -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">2. Legalitas, Agunan & RAC Compliance</h4>
                        <div class="divide-y divide-slate-200 text-xs">
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Bentuk Legalitas Usaha:</span>
                                <strong class="text-slate-900">{{ strtoupper($user->business->legal_form ?? 'PT') }} (Akta Kemenkumham Lengkap)</strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Coverage Agunan SHM:</span>
                                <strong class="text-emerald-700">166.67% terhadap Plafon Rp 1.5M</strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Debt Service Ratio (DSR):</span>
                                <strong class="text-emerald-700">28.50% &bull; Kapasitas Pembayaran Aman</strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">Daftar Hitam Nasional (DHN):</span>
                                <strong class="text-emerald-700">Tidak Terdaftar (Bersih 100%)</strong>
                            </div>
                            <div class="py-2 flex justify-between">
                                <span class="text-slate-600">SLIK OJK Kolektibilitas:</span>
                                <strong class="text-emerald-700">Kol 1 (Lancar Nihil Tunggakan)</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom CTA Actions -->
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        &larr; Kembali ke Dashboard
                    </a>

                    <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                        <a href="{{ route('scoring.certificate') }}" 
                           class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition text-xs flex items-center gap-2">
                            <span>Buka Sertifikat Rating Resmi &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Bar Chart 4P
            const ctx4P = document.getElementById('chart4P');
            if (ctx4P) {
                new Chart(ctx4P, {
                    type: 'bar',
                    data: {
                        labels: ['Personality', 'Purpose', 'Productivity', 'Payment'],
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
                            borderColor: [
                                '#1D4ED8',
                                '#2563EB',
                                '#4F46E5',
                                '#059669'
                            ],
                            borderWidth: 1.5,
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ' Nilai: ' + context.raw + ' pts';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 35,
                                grid: { color: '#F1F5F9' }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            // 2. Bar Chart 5C
            const ctx5C = document.getElementById('chart5C');
            if (ctx5C) {
                new Chart(ctx5C, {
                    type: 'bar',
                    data: {
                        labels: ['Character', 'Capacity', 'Collateral', 'Capital', 'Condition'],
                        datasets: [{
                            label: 'Skor 5C',
                            data: [
                                {{ $scoring->score_5c_character }},
                                {{ $scoring->score_5c_capacity }},
                                {{ $scoring->score_5c_collateral }},
                                {{ $scoring->score_5c_capital }},
                                {{ $scoring->score_5c_condition }}
                            ],
                            backgroundColor: 'rgba(79, 70, 229, 0.85)',
                            borderColor: '#4338CA',
                            borderWidth: 1.5,
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ' Nilai: ' + context.raw + ' pts';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 35,
                                grid: { color: '#F1F5F9' }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            // 3. Radar Chart Big-Five
            const ctxBigFive = document.getElementById('chartBigFive');
            if (ctxBigFive) {
                new Chart(ctxBigFive, {
                    type: 'radar',
                    data: {
                        labels: ['Openness (Inovasi)', 'Conscientious (Disiplin)', 'Extraversion (Relasi)', 'Agreeable (Integritas)', 'Stability (Resiliensi)'],
                        datasets: [{
                            label: 'Tingkat Dimensi (%)',
                            data: [
                                {{ $scoring->big5_openness }},
                                {{ $scoring->big5_conscientiousness }},
                                {{ $scoring->big5_extraversion }},
                                {{ $scoring->big5_agreeableness }},
                                {{ $scoring->big5_neuroticism }}
                            ],
                            fill: true,
                            backgroundColor: 'rgba(147, 51, 234, 0.2)',
                            borderColor: '#9333EA',
                            pointBackgroundColor: '#7E22CE',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: '#7E22CE',
                            borderWidth: 2
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
                                    font: { size: 10, weight: '600' },
                                    color: '#475569'
                                },
                                suggestedMin: 0,
                                suggestedMax: 100
                            }
                        }
                    }
                });
            }

        });
    </script>
</x-app-layout>
