<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <!-- Header Title as per Gambar 5 -->
        <div class="text-center max-w-xl mx-auto mb-10">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Pilih Profil Skoring</h1>
            <p class="text-sm text-slate-500 mt-2">
                Pilih kategori entitas usaha Anda untuk menyesuaikan formulir data dan parameter penilaian kelayakan kredit.
            </p>
        </div>

        <form method="POST" action="{{ route('wizard.save-profile-type') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Option 1: Perorangan -->
                <label class="relative block rounded-3xl bg-white p-8 border-2 border-slate-200 hover:border-blue-500 hover:shadow-xl transition-all cursor-pointer group text-center">
                    <input type="radio" 
                           name="business_type" 
                           value="perorangan" 
                           class="sr-only peer"
                           {{ ($business->business_type ?? 'badan_hukum') === 'perorangan' ? 'checked' : '' }}>
                    
                    <div class="peer-checked:border-blue-600 peer-checked:ring-4 peer-checked:ring-blue-600/10 absolute inset-0 rounded-3xl border-2 pointer-events-none transition"></div>

                    <!-- Icon Perorangan -->
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-2">Perorangan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-xs mx-auto">
                        Bagi Anda yang memiliki usaha perseorangan, UMKM mikro, toko/warung, atau usaha mandiri belum berbadan hukum.
                    </p>

                    <div class="mt-6 inline-flex items-center text-xs font-bold text-blue-600 group-hover:translate-x-1 transition">
                        Pilih Profil Perorangan &rarr;
                    </div>
                </label>

                <!-- Option 2: Perusahaan / Badan Hukum -->
                <label class="relative block rounded-3xl bg-white p-8 border-2 border-slate-200 hover:border-blue-500 hover:shadow-xl transition-all cursor-pointer group text-center">
                    <input type="radio" 
                           name="business_type" 
                           value="badan_hukum" 
                           class="sr-only peer"
                           {{ ($business->business_type ?? 'badan_hukum') === 'badan_hukum' ? 'checked' : '' }}>
                    
                    <div class="peer-checked:border-blue-600 peer-checked:ring-4 peer-checked:ring-blue-600/10 absolute inset-0 rounded-3xl border-2 pointer-events-none transition"></div>

                    <!-- Icon Perusahaan -->
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-2">Perusahaan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-xs mx-auto">
                        Bagi Anda yang memiliki usaha berbadan hukum resmi (PT, CV, Koperasi, UD) dengan akta notaris & Kemenkumham.
                    </p>

                    <div class="mt-6 inline-flex items-center text-xs font-bold text-blue-600 group-hover:translate-x-1 transition">
                        Pilih Profil Perusahaan &rarr;
                    </div>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" 
                        class="px-10 py-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-2xl shadow-xl shadow-blue-500/25 transition duration-150 transform hover:-translate-y-0.5 text-sm flex items-center gap-2">
                    Lanjutkan ke Pengisian Data
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
