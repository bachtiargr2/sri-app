<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SRI - SME Rating Indonesia') }}</title>

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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-slate-900 antialiased bg-[#0D1527]">
        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Left Side: Indonesian Cultural Wayang Motif & SRI Brand Visual (Gambar 3 & Gambar 4) -->
            <div class="relative lg:w-1/2 flex flex-col justify-between overflow-hidden bg-[#0B1528]">
                <!-- Wayang Illustration occupying panel -->
                <div class="relative flex-1 w-full flex items-center justify-center overflow-hidden min-h-[380px] lg:min-h-full">
                    <!-- Wayang Image -->
                    <img src="{{ asset('images/wayang-sri.png') }}" 
                         onerror="this.onerror=null; this.src='{{ asset('images/wayang-sri.jpg') }}';" 
                         alt="SRI Wayang Identity" 
                         class="w-full h-full object-contain lg:object-cover object-center select-none pointer-events-none">
                    
                    <!-- Overlay shadow/gradient for bottom blend -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B1528] via-[#0B1528]/20 to-transparent"></div>

                    <!-- Bottom Left SRI SME Rating Indonesia Logo as per Gambar 3 & 4 -->
                    <div class="absolute bottom-8 left-8 sm:bottom-12 sm:left-12 z-20 flex items-center gap-3">
                        <span class="text-4xl sm:text-5xl font-black tracking-wider text-white drop-shadow-[0_2px_10px_rgba(0,0,0,0.8)]">SRI</span>
                        <div class="pl-3 border-l-2 border-slate-400 text-left flex flex-col justify-center leading-none">
                            <span class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider drop-shadow">SME</span>
                            <span class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider drop-shadow">Rating</span>
                            <span class="text-[10px] sm:text-xs text-slate-300 font-medium drop-shadow">Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Auth Form Container -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-10 lg:p-16 bg-[#F8FAFC]">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>

