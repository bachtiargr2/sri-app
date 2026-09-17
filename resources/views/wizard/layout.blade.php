<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Proses Skoring' }} - SRI SME Rating Indonesia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#F8FAFC] text-slate-800 selection:bg-blue-600 selection:text-white">
    <!-- Top Header Navigation -->
    <header class="bg-[#1E40AF] border-b border-blue-900/60 text-white shadow-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-6">
                    <!-- Logo SRI -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-blue-800 font-black text-sm shadow group-hover:scale-105 transition">
                            S
                        </div>
                        <div class="flex items-center tracking-tight text-left">
                            <span class="text-xl font-black text-white">SRI</span>
                            <div class="ml-2 pl-2 border-l border-blue-300/40 flex flex-col leading-none">
                                <span class="text-[9px] font-bold text-blue-100 uppercase tracking-wider">SME</span>
                                <span class="text-[9px] font-bold text-blue-100 uppercase tracking-wider">Rating</span>
                                <span class="text-[7px] text-blue-200">Indonesia</span>
                            </div>
                        </div>
                    </a>

                    <span class="hidden md:inline-block text-blue-300/50">/</span>
                    <a href="{{ route('dashboard') }}" class="hidden md:inline-block text-xs font-semibold text-blue-200 hover:text-white transition">
                        Dashboard Nasabah
                    </a>
                    <span class="hidden md:inline-block text-blue-300/50">/</span>
                    <span class="hidden md:inline-block font-semibold text-xs uppercase tracking-wider text-blue-100 bg-blue-900/40 px-3 py-1 rounded-full border border-blue-400/30">
                        Proses Skoring
                    </span>
                </div>

                <!-- Right User Info -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-xs text-blue-100">
                        <div class="w-7 h-7 rounded-full bg-blue-700 border border-blue-400/40 flex items-center justify-center text-xs font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:inline">Profile: <strong class="text-white">{{ Auth::user()->name }}</strong></span>
                    </div>
                    <span class="text-blue-300/40">|</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs font-semibold text-blue-200 hover:text-white transition px-2 py-1 rounded hover:bg-blue-800/60">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Scoring Layout Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Sidebar Navigation (Gambar 5 - 23) -->
            <aside class="lg:col-span-3 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-6">
                <div>
                    <h3 class="text-sm font-black uppercase tracking-wider text-blue-900">Proses Skoring</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Tahapan penilaian kelayakan kredit UMKM</p>
                </div>

                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                <!-- Step List -->
                <nav class="space-y-2 text-xs">
                    <!-- Step 1: Profil Diri -->
                    <a href="{{ route('wizard.personal-profile') }}" 
                       class="flex items-center gap-3 p-3 rounded-xl font-medium transition {{ str_contains($currentRoute, 'personal-profile') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="w-2.5 h-2.5 rounded-full {{ str_contains($currentRoute, 'personal-profile') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                        <span>Profil Diri</span>
                    </a>

                    <!-- Step 2: Profil Usaha -->
                    <a href="{{ route('wizard.business-profile') }}" 
                       class="flex items-center gap-3 p-3 rounded-xl font-medium transition {{ str_contains($currentRoute, 'business-profile') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="w-2.5 h-2.5 rounded-full {{ str_contains($currentRoute, 'business-profile') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                        <span>Profil Usaha</span>
                    </a>

                    <!-- Step 3: Kinerja Keuangan & Rasio -->
                    <div class="space-y-1">
                        <a href="{{ route('wizard.financial-report') }}" 
                           class="flex items-center gap-3 p-3 rounded-xl font-medium transition {{ in_array($currentRoute, ['wizard.financial-report', 'wizard.collateral', 'wizard.management', 'wizard.prospect', 'wizard.productivity', 'wizard.payment']) ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span class="w-2.5 h-2.5 rounded-full {{ in_array($currentRoute, ['wizard.financial-report', 'wizard.collateral', 'wizard.management', 'wizard.prospect', 'wizard.productivity', 'wizard.payment']) ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                            <span>Kinerja Keuangan & Rasio</span>
                        </a>

                        @if(in_array($currentRoute, ['wizard.financial-report', 'wizard.collateral', 'wizard.management', 'wizard.prospect', 'wizard.productivity', 'wizard.payment']))
                            <div class="pl-8 space-y-1 py-1 text-[11px] border-l-2 border-blue-100 ml-4">
                                <a href="{{ route('wizard.financial-report') }}" class="block py-1 {{ $currentRoute == 'wizard.financial-report' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-800' }}">&bull; Laporan Keuangan</a>
                                <a href="{{ route('wizard.collateral') }}" class="block py-1 {{ $currentRoute == 'wizard.collateral' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-800' }}">&bull; Data Agunan</a>
                                <a href="{{ route('wizard.management') }}" class="block py-1 {{ $currentRoute == 'wizard.management' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-800' }}">&bull; Profil Manajemen</a>
                                <a href="{{ route('wizard.prospect') }}" class="block py-1 {{ $currentRoute == 'wizard.prospect' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-800' }}">&bull; Prospek Bisnis</a>
                                <a href="{{ route('wizard.productivity') }}" class="block py-1 {{ $currentRoute == 'wizard.productivity' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-800' }}">&bull; Produktivitas</a>
                                <a href="{{ route('wizard.payment') }}" class="block py-1 {{ $currentRoute == 'wizard.payment' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-800' }}">&bull; Payment & RAC</a>
                            </div>
                        @endif
                    </div>

                    <!-- Step 4: Karakter Kewirausahaan -->
                    <a href="{{ route('wizard.character-assessment') }}" 
                       class="flex items-center gap-3 p-3 rounded-xl font-medium transition {{ str_contains($currentRoute, 'character-assessment') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="w-2.5 h-2.5 rounded-full {{ str_contains($currentRoute, 'character-assessment') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                        <span>Karakter Kewirausahaan</span>
                    </a>

                    <!-- Step 5: Ringkasan Kelengkapan -->
                    <a href="{{ route('wizard.completion') }}" 
                       class="flex items-center gap-3 p-3 rounded-xl font-medium transition {{ str_contains($currentRoute, 'completion') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="w-2.5 h-2.5 rounded-full {{ str_contains($currentRoute, 'completion') ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                        <span>Ringkasan Kelengkapan</span>
                    </a>
                </nav>

                <div class="pt-4 border-t border-slate-100">
                    <a href="{{ route('wizard.choose-profile') }}" class="text-[11px] font-semibold text-blue-600 hover:underline flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Ubah Tipe Profil Usaha
                    </a>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="lg:col-span-9 space-y-6">
                <!-- Flash Status Alert -->
                @if (session('status'))
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if (session('info'))
                    <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>

        </div>
    </div>
</body>
</html>
