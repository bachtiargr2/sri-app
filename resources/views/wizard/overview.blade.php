<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Lengkapi Profil dan Data Usaha Anda</h1>
                <p class="text-xs text-slate-500 mt-1">Lengkapi 4 tahapan penilaian berikut untuk memulai kalkulasi credit scoring dan rating usaha.</p>
            </div>
            <a href="{{ route('wizard.choose-profile') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Tipe: <span class="capitalize font-bold">{{ $user->business->business_type ?? 'Perusahaan' }}</span> (Ubah)
            </a>
        </div>

        <!-- 4 Grid Cards matching Gambar 6 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Card 1: Profil Diri -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between hover:border-blue-300 transition">
                <div class="space-y-1">
                    <h3 class="text-base font-bold text-slate-900">Profil Diri</h3>
                    <p class="text-xs text-slate-500">Lengkapi profil Anda sebagai pemohon / penjamin</p>
                    <div class="pt-2">
                        @if($hasProfile)
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                                ✓ Lengkap
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                                &bull; Belum Lengkap
                            </span>
                        @endif
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 2: Profil Usaha -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between hover:border-blue-300 transition">
                <div class="space-y-1">
                    <h3 class="text-base font-bold text-slate-900">Profil Usaha</h3>
                    <p class="text-xs text-slate-500">Lengkapi profil legalitas dan kapasitas usaha</p>
                    <div class="pt-2">
                        @if($hasBusiness)
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                                ✓ Lengkap
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                                &bull; Belum Lengkap
                            </span>
                        @endif
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>

            <!-- Card 3: Kinerja Keuangan -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between hover:border-blue-300 transition">
                <div class="space-y-1">
                    <h3 class="text-base font-bold text-slate-900">Kinerja Keuangan</h3>
                    <p class="text-xs text-slate-500">Lengkapi data laporan keuangan 3 periode usaha Anda</p>
                    <div class="pt-2">
                        @if($hasFinancial)
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                                ✓ Lengkap
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                                &bull; Belum Lengkap
                            </span>
                        @endif
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 4: Karakter Kewirausahaan -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between hover:border-blue-300 transition">
                <div class="space-y-1">
                    <h3 class="text-base font-bold text-slate-900">Karakter Kewirausahaan</h3>
                    <p class="text-xs text-slate-500">Lakukan asesmen kepribadian mengenai wawasan kewirausahaan</p>
                    <div class="pt-2">
                        @if($hasCharacter)
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                                ✓ Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                                &bull; Belum Tes
                            </span>
                        @endif
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Action Bottom Buttons matching Gambar 6 -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
            <a href="{{ route('wizard.personal-profile') }}" 
               class="w-full sm:w-auto px-8 py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center justify-center gap-2">
                Cek Formulir / Mulai Isi
            </a>

            <a href="{{ route('wizard.completion') }}" 
               class="w-full sm:w-auto px-8 py-3.5 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-bold rounded-xl shadow-sm transition duration-150 text-xs flex items-center justify-center gap-2">
                Resume & Kelengkapan
            </a>
        </div>

    </div>
</x-app-layout>
