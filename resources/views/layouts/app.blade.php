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

        <!-- Chart.js CDN for Financial & Psychogram Visualizations -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-[#F8FAFC] text-slate-800 selection:bg-blue-600 selection:text-white">
        <div class="min-h-screen flex flex-col justify-between">
            <div>
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white border-b border-slate-200">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            <!-- Global Clean Footer -->
            <footer class="bg-white border-t border-slate-200 py-6 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-blue-900">SRI</span>
                        <span>&bull;</span>
                        <span>SME Rating Indonesia &copy; {{ date('Y') }}</span>
                    </div>
                    <div>
                        Platform Manajemen Pemeringkatan Kredit UMKM Terintegrasi
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>


