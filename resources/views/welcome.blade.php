<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRI - SME Rating Indonesia | Platform Manajemen Pemeringkatan Kredit</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Figtree', 'sans-serif'],
                        },
                        colors: {
                            sri: {
                                50: '#F0F7FF',
                                100: '#E0EFFF',
                                200: '#BAE0FD',
                                500: '#2563EB',
                                600: '#1D4ED8',
                                700: '#1E40AF',
                                800: '#1E3A8A',
                                900: '#0F172A',
                                navy: '#0B1528',
                                dark: '#111827',
                            }
                        }
                    }
                }
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased text-slate-800 bg-[#F8FAFC]">
        <!-- Top Navigation -->
        <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/80 transition-all">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Brand SRI -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-black text-xl shadow-md shadow-blue-500/20">
                            S
                        </div>
                        <div class="flex flex-col text-slate-900 leading-tight">
                            <span class="text-xl font-black tracking-tight text-blue-900">SRI</span>
                            <span class="text-[10px] font-bold text-slate-500 tracking-wider">SME RATING INDONESIA</span>
                        </div>
                    </div>

                    <!-- Top Menu & Action -->
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" 
                                   class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-600/20 transition">
                                    Buka Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="px-4 py-2 font-semibold text-sm text-slate-600 hover:text-blue-600 transition">
                                    Sign In
                                </a>
                                <a href="{{ route('register') }}" 
                                   class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-600/20 transition">
                                    Mulai Bergabung
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section (Gambar 2: Halaman Awal & Bab 2.1) -->
        <main>
            <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        
                        <!-- Left Hero Content -->
                        <div class="lg:col-span-6 space-y-8">
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200/60 text-blue-700 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                                Platform Pemeringkatan & Penjaminan Kredit UMKM
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-3xl font-black text-blue-900 tracking-wider">SRI</span>
                                    <div class="pl-3 border-l-2 border-slate-300 text-left">
                                        <div class="text-xs font-bold text-slate-700 uppercase leading-tight">SME</div>
                                        <div class="text-xs font-bold text-slate-700 uppercase leading-tight">Rating</div>
                                        <div class="text-[10px] text-slate-500 font-medium leading-tight">Indonesia</div>
                                    </div>
                                </div>

                                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                                    Platform manajemen pemeringkatan kredit <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-500">yang terpercaya</span> bagi usaha Anda
                                </h1>

                                <p class="text-base sm:text-lg text-slate-600 max-w-xl leading-relaxed">
                                    Tingkatkan kredibilitas finansial dan kelayakan pembiayaan usaha Anda secara objektif, transparan, dan terintegrasi langsung dengan perbankan serta lembaga penjaminan.
                                </p>
                            </div>

                            <!-- CTA Buttons (Bab 2.1 Mulai Bergabung) -->
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-2">
                                <a href="{{ route('register') }}" 
                                   class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-bold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 shadow-xl shadow-blue-500/25 transition duration-150 transform hover:-translate-y-0.5">
                                    Mulai Bergabung
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>

                                <a href="{{ route('login') }}" 
                                   class="inline-flex items-center justify-center px-7 py-4 rounded-xl text-base font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 shadow-sm transition">
                                    Sudah Punya Akun? Masuk
                                </a>
                            </div>

                            <!-- Trust Badges / Stats -->
                            <div class="pt-6 border-t border-slate-200/80 grid grid-cols-3 gap-4 sm:gap-6">
                                <div>
                                    <p class="text-xl sm:text-2xl font-extrabold text-blue-900">5C & 4P</p>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium mt-0.5">Metodologi Skoring Komprehensif</p>
                                </div>
                                <div>
                                    <p class="text-xl sm:text-2xl font-extrabold text-blue-900">Big-Five</p>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium mt-0.5">Asesmen Karakter Kewirausahaan</p>
                                </div>
                                <div>
                                    <p class="text-xl sm:text-2xl font-extrabold text-blue-900">100%</p>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium mt-0.5">Mitra Bank & Penjamin</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Hero Visual: Elegant Split Card (35% Wayang Image + 65% Simulation Card) -->
                        <div class="lg:col-span-6">
                            <div class="relative mx-auto max-w-xl lg:max-w-none">
                                <!-- Backdrop Ambient Glow -->
                                <div class="absolute -inset-3 bg-gradient-to-tr from-blue-600/25 via-indigo-600/20 to-blue-400/25 rounded-3xl blur-2xl opacity-70 pointer-events-none"></div>

                                <!-- Unified Card Container -->
                                <div class="relative bg-gradient-to-br from-[#0B1528] via-[#0F224A] to-[#1E3A8A] rounded-3xl text-white shadow-2xl border border-white/15 overflow-hidden flex flex-col sm:flex-row">
                                    
                                    <!-- 1. Left Sub-Panel (Wayang Visual ~35%) -->
                                    <div class="sm:w-[36%] relative overflow-hidden bg-slate-950 flex flex-col justify-end min-h-[220px] sm:min-h-full border-b sm:border-b-0 sm:border-r border-white/10">
                                        <!-- Wayang Image -->
                                        <img src="{{ asset('images/wayang-sri.png') }}" 
                                             onerror="this.onerror=null; this.src='{{ asset('images/wayang-sri.jpg') }}';" 
                                             alt="SRI Wayang Heritage" 
                                             class="absolute inset-0 w-full h-full object-cover object-center select-none">
                                        
                                        <!-- Soft Navy Gradient Overlay -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1528] via-[#0B1528]/40 to-transparent"></div>

                                        <!-- Bottom Text on Wayang side -->
                                        <div class="relative z-10 p-5">
                                            <p class="text-xs font-bold text-white leading-tight">Pemeringkatan UMKM</p>
                                            <p class="text-[10px] text-blue-200/80 mt-0.5">SME Rating Indonesia</p>
                                        </div>
                                    </div>

                                    <!-- 2. Right Sub-Panel (Rating Simulation ~65%) -->
                                    <div class="sm:w-[64%] p-6 sm:p-7 flex flex-col justify-between space-y-4">
                                        <!-- Card Top Header -->
                                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8 h-8 rounded-lg bg-blue-500/20 border border-blue-400/30 flex items-center justify-center font-bold text-xs text-blue-300">
                                                    SRI
                                                </div>
                                                <div>
                                                    <h4 class="text-xs font-bold leading-tight">Simulasi Rating Debitur</h4>
                                                    <p class="text-[10px] text-blue-200/70">PT Maju Bersama Sejahtera</p>
                                                </div>
                                            </div>
                                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 whitespace-nowrap">
                                                Bb / 740
                                            </span>
                                        </div>

                                        <!-- Progress Stepper Miniature -->
                                        <div class="p-3 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                            <div class="flex justify-between items-center text-[11px] text-blue-200 mb-1.5">
                                                <span>6 Tahap Proses Pemeringkatan</span>
                                                <span class="font-bold text-blue-300 text-[10px]">Tahap 1 Aktif</span>
                                            </div>
                                            <div class="w-full bg-blue-950/80 rounded-full h-1.5">
                                                <div class="bg-blue-400 h-1.5 rounded-full w-1/6"></div>
                                            </div>
                                        </div>

                                        <!-- Score Indicators Grid -->
                                        <div class="grid grid-cols-2 gap-2.5">
                                            <div class="p-3 rounded-xl bg-white/5 border border-white/10">
                                                <p class="text-[10px] text-blue-200/75">Skor Kinerja 5C</p>
                                                <p class="text-base font-bold text-white mt-0.5">79.58 <span class="text-[10px] text-emerald-400 font-medium block sm:inline">Baik</span></p>
                                            </div>
                                            <div class="p-3 rounded-xl bg-white/5 border border-white/10">
                                                <p class="text-[10px] text-blue-200/75">SLIK / IDScore</p>
                                                <p class="text-base font-bold text-emerald-400 mt-0.5">1 - Lancar</p>
                                            </div>
                                        </div>

                                        <!-- Ready to Apply Callout Footer -->
                                        <div class="p-3 rounded-xl bg-blue-600/30 border border-blue-400/30 flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-blue-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-[11px] font-semibold text-blue-100">Kredit & Penjaminan Siap Diajukan</span>
                                            </div>
                                            <span class="text-[11px] font-bold text-blue-300">TRX...</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- 6 Tahapan Proses Flow Section -->
            <section class="py-16 bg-white border-y border-slate-200/80">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-12">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-blue-600">Alur Bisnis Terintegrasi</h2>
                        <p class="mt-2 text-3xl font-extrabold text-slate-900 tracking-tight">6 Tahap Menuju Akses Pembiayaan Terbaik</p>
                        <p class="mt-3 text-slate-600 text-sm">Ikuti langkah terstruktur dari pendaftaran hingga kolaborasi dengan bank dan lembaga penjaminan.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Step 1 -->
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-400 transition group">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center mb-4 shadow-md group-hover:scale-105 transition">1</div>
                            <h3 class="text-base font-bold text-slate-900">Pendaftaran Pengguna</h3>
                            <p class="mt-2 text-xs text-slate-600 leading-relaxed">Registrasi akun mandiri dengan verifikasi email dan data dasar pengguna yang aman.</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-400 transition group">
                            <div class="w-10 h-10 rounded-xl bg-slate-700 text-white font-bold flex items-center justify-center mb-4 group-hover:scale-105 transition">2</div>
                            <h3 class="text-base font-bold text-slate-900">Pengisian Data Calon Debitur</h3>
                            <p class="mt-2 text-xs text-slate-600 leading-relaxed">Profil diri, data usaha, laporan keuangan 3 periode, data agunan, profil manajemen, dan tes Big-Five.</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-400 transition group">
                            <div class="w-10 h-10 rounded-xl bg-slate-700 text-white font-bold flex items-center justify-center mb-4 group-hover:scale-105 transition">3</div>
                            <h3 class="text-base font-bold text-slate-900">Proses & Hasil Pemeringkatan</h3>
                            <p class="mt-2 text-xs text-slate-600 leading-relaxed">Kalkulasi otomatis skoring 5C & 4P, visualisasi grafik, dan penerbitan sertifikat rating (e.g. Bb / 740).</p>
                        </div>

                        <!-- Step 4 -->
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-400 transition group">
                            <div class="w-10 h-10 rounded-xl bg-slate-700 text-white font-bold flex items-center justify-center mb-4 group-hover:scale-105 transition">4</div>
                            <h3 class="text-base font-bold text-slate-900">Pengajuan & Rekomendasi</h3>
                            <p class="mt-2 text-xs text-slate-600 leading-relaxed">Sistem merekomendasikan skema pembiayaan yang presisi berdasarkan hasil pemeringkatan.</p>
                        </div>

                        <!-- Step 5 -->
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-400 transition group">
                            <div class="w-10 h-10 rounded-xl bg-slate-700 text-white font-bold flex items-center justify-center mb-4 group-hover:scale-105 transition">5</div>
                            <h3 class="text-base font-bold text-slate-900">Pilihan Pengajuan</h3>
                            <p class="mt-2 text-xs text-slate-600 leading-relaxed">Pilihan jalur pengajuan: Kredit Perbankan, Penjaminan Cash Loan, atau Penjaminan Non-Cash Loan.</p>
                        </div>

                        <!-- Step 6 -->
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-400 transition group">
                            <div class="w-10 h-10 rounded-xl bg-slate-700 text-white font-bold flex items-center justify-center mb-4 group-hover:scale-105 transition">6</div>
                            <h3 class="text-base font-bold text-slate-900">Kolaborasi Mitra & TRX</h3>
                            <p class="mt-2 text-xs text-slate-600 leading-relaxed">Matching instan ke Bank & Lembaga Penjamin dengan konfirmasi nomor transaksi TRX.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-[#0B1528] text-white py-12 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-black text-sm">
                        S
                    </div>
                    <div>
                        <p class="text-sm font-bold">SRI - SME Rating Indonesia</p>
                        <p class="text-xs text-slate-400">Platform Pemeringkatan Kredit UMKM Terpercaya</p>
                    </div>
                </div>
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} SME Rating Indonesia. Seluruh hak cipta dilindungi undang-undang.
                </p>
            </div>
        </footer>
    </body>
</html>
