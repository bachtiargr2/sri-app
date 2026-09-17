<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Top Actions Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200 print:hidden">
                <div class="flex items-center gap-2">
                    <a href="{{ route('scoring.summary') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition">
                        &larr; Ringkasan Penilaian
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition">
                        Dashboard
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" 
                            onclick="window.print()" 
                            class="px-5 py-2.5 rounded-xl border border-blue-200 bg-white hover:bg-blue-50 text-blue-700 font-bold text-xs shadow-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Cetak Sertifikat
                    </button>
                    <button type="button" 
                            onclick="alert('Sertifikat Pemeringkatan SRI (PDF) berhasil diunduh.');" 
                            class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/25 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download PDF
                    </button>
                </div>
            </div>

            <!-- Certificate Frame (Sesuai Gambar 26 & Standar Finansial SRI) -->
            <div class="bg-white rounded-3xl p-8 sm:p-12 border-8 border-double border-blue-900 shadow-2xl relative overflow-hidden text-slate-900">
                
                <!-- Background Subtle Watermark Overlay -->
                <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none select-none">
                    <img src="{{ asset('images/wayang-sri.png') }}" alt="Watermark" class="w-96 h-96 object-contain">
                </div>

                <!-- Certificate Inner Border Header -->
                <div class="text-center space-y-3 pb-8 border-b-2 border-slate-200 relative z-10">
                    <div class="flex items-center justify-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-[#1E40AF] text-white flex items-center justify-center text-xl font-black shadow-md">
                            S
                        </div>
                        <div class="text-left">
                            <span class="text-2xl font-black text-[#1E40AF] tracking-tight block">SRI</span>
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500 block -mt-1">SME Rating Indonesia</span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <h2 class="text-2xl sm:text-3xl font-black tracking-wide text-slate-900 uppercase">
                            Sertifikat Pemeringkatan UMKM
                        </h2>
                        <p class="text-xs text-slate-500 uppercase tracking-widest mt-0.5">SME Credit Rating Certificate</p>
                    </div>

                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-blue-900 text-xs font-mono font-bold">
                        <span>Nomor Sertifikat:</span>
                        <span class="text-blue-700 font-black">{{ $scoring->certificate_id ?? 'CRTYES20260001' }}</span>
                    </div>
                </div>

                <!-- Certificate Body Content -->
                <div class="py-8 space-y-6 relative z-10">
                    
                    <div class="text-center space-y-1">
                        <p class="text-xs text-slate-500 uppercase tracking-wider">Dengan ini menerangkan bahwa:</p>
                        <h3 class="text-2xl sm:text-3xl font-black text-[#1E40AF]">
                            {{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}
                        </h3>
                        <p class="text-xs text-slate-600">
                            Nama Pemilik / Direktur: <strong>{{ $user->profile->full_name ?? $user->name }}</strong> &bull; NIK: <span class="font-mono">{{ $user->profile->id_card_number ?? '123848484939020' }}</span>
                        </p>
                        <p class="text-[11px] text-slate-500">
                            {{ $user->business->business_address ?? 'Jl. Jenderal Sudirman Kav. 52-53, Jakarta Selatan' }}
                        </p>
                    </div>

                    <!-- Rating Result Callout Box (Gambar 26) -->
                    <div class="my-6 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-blue-50/70 via-slate-50 to-indigo-50/70 border-2 border-blue-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="space-y-2 text-center sm:text-left">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-600 text-white">
                                Predikat Kelayakan Kredit
                            </span>
                            <h4 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">
                                Peringkat {{ $scoring->rating_grade }} (Skor: {{ $scoring->credit_score }})
                            </h4>
                            <p class="text-xs text-slate-600 max-w-lg leading-relaxed">
                                {{ $scoring->rating_description }}
                            </p>
                        </div>

                        <!-- Big Grade Circle -->
                        <div class="w-28 h-28 rounded-3xl bg-gradient-to-br from-[#1E40AF] to-blue-700 text-white flex flex-col items-center justify-center shrink-0 shadow-lg shadow-blue-600/30 ring-4 ring-white">
                            <span class="text-4xl font-black tracking-tight leading-none">{{ $scoring->rating_grade }}</span>
                            <span class="text-[10px] font-bold text-blue-200 mt-1">SKOR {{ $scoring->credit_score }}</span>
                        </div>
                    </div>

                    <!-- Score Dimensions Matrix -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] font-bold uppercase text-slate-500 block">Total 5C</span>
                            <strong class="text-base font-black text-slate-900 mt-0.5 block">{{ $scoring->score_5c_total }} / 100</strong>
                            <span class="text-[10px] text-slate-400">Prinsip Kredit</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] font-bold uppercase text-slate-500 block">Total 4P</span>
                            <strong class="text-base font-black text-slate-900 mt-0.5 block">{{ $scoring->score_4p_total }} / 100</strong>
                            <span class="text-[10px] text-slate-400">Kapasitas Usaha</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] font-bold uppercase text-slate-500 block">Karakter Wirausaha</span>
                            <strong class="text-base font-black text-purple-700 mt-0.5 block">82.00%</strong>
                            <span class="text-[10px] text-slate-400">Big-Five Valid</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] font-bold uppercase text-slate-500 block">SLIK OJK</span>
                            <strong class="text-base font-black text-emerald-700 mt-0.5 block">Kol 1 - Lancar</strong>
                            <span class="text-[10px] text-slate-400">Nihil Tunggakan</span>
                        </div>
                    </div>

                </div>

                <!-- Certificate Footer & Validation Signatures (Gambar 26) -->
                <div class="pt-8 border-t-2 border-slate-200 grid grid-cols-1 sm:grid-cols-3 items-center gap-6 relative z-10">
                    
                    <!-- Left: QR Code Dummy Validation -->
                    <div class="flex items-center gap-3">
                        <div class="w-20 h-20 bg-white p-1.5 rounded-2xl border-2 border-slate-300 shadow-sm flex items-center justify-center shrink-0">
                            <!-- SVG QR Code Vector -->
                            <svg class="w-full h-full text-slate-900" viewBox="0 0 100 100" fill="currentColor">
                                <rect x="5" y="5" width="30" height="30" rx="4" fill="none" stroke="currentColor" stroke-width="6"/>
                                <rect x="14" y="14" width="12" height="12" fill="currentColor"/>
                                <rect x="65" y="5" width="30" height="30" rx="4" fill="none" stroke="currentColor" stroke-width="6"/>
                                <rect x="74" y="14" width="12" height="12" fill="currentColor"/>
                                <rect x="5" y="65" width="30" height="30" rx="4" fill="none" stroke="currentColor" stroke-width="6"/>
                                <rect x="14" y="74" width="12" height="12" fill="currentColor"/>
                                <rect x="45" y="10" width="8" height="8" fill="currentColor"/>
                                <rect x="45" y="25" width="8" height="8" fill="currentColor"/>
                                <rect x="45" y="45" width="10" height="10" fill="currentColor"/>
                                <rect x="65" y="45" width="10" height="10" fill="currentColor"/>
                                <rect x="65" y="65" width="8" height="8" fill="currentColor"/>
                                <rect x="80" y="65" width="10" height="10" fill="currentColor"/>
                                <rect x="45" y="75" width="8" height="15" fill="currentColor"/>
                                <rect x="75" y="80" width="15" height="10" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="text-[10px] text-slate-500">
                            <strong class="text-slate-800 block text-xs">Pindai QR Validasi</strong>
                            <span>Scan untuk memverifikasi keaslian digital sertifikat SRI.</span>
                        </div>
                    </div>

                    <!-- Middle: Validity Period & Stamp -->
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto rounded-full border-2 border-red-600/60 bg-red-50/50 flex flex-col items-center justify-center text-[9px] font-black text-red-700 uppercase leading-none transform -rotate-12">
                            <span>SRI OFFICIAL</span>
                            <span class="text-[7px] text-red-600 mt-0.5">VERIFIED</span>
                        </div>
                        <span class="text-[10px] text-slate-500 block mt-1">Masa Berlaku: 1 (Satu) Tahun</span>
                    </div>

                    <!-- Right: Digital Signature -->
                    <div class="text-center sm:text-right space-y-1">
                        <span class="text-[11px] text-slate-500 block">Diterbitkan di Jakarta, {{ date('d F Y') }}</span>
                        <div class="h-10 flex items-center justify-center sm:justify-end">
                            <span class="font-serif italic text-lg text-blue-900 font-bold">Komite Pemeringkat SRI</span>
                        </div>
                        <strong class="text-xs text-slate-900 block border-t border-slate-300 pt-1">SME Rating Indonesia</strong>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
