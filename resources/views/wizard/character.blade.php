@include('wizard.layout', ['title' => 'Asesmen Karakter Kewirausahaan', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">

    @if($isCompleted)
        <!-- Completed State (Gambar 22 & Bab 3.6) -->
        <div class="py-8 text-center space-y-6 max-w-2xl mx-auto">
            <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-sm ring-8 ring-emerald-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                    ✓ Asesmen Selesai & Terkunci
                </span>
                <h2 class="text-2xl font-black text-slate-900">Asesmen Karakter Kewirausahaan Selesai</h2>
                <p class="text-xs text-slate-500 mt-2 max-w-lg mx-auto">
                    Data psikometri 20 dimensi Big-Five Personality telah tersimpan secara permanen pada sistem SRI dan tidak dapat diubah kembali untuk menjaga integritas pemeringkatan.
                </p>
            </div>

            <!-- Big Five Radar / Summary Preview -->
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 text-left pt-2">
                <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100">
                    <span class="text-[10px] font-bold text-blue-800 uppercase block">Openness</span>
                    <span class="text-base font-black text-blue-900 mt-0.5 block">82.00%</span>
                    <span class="text-[10px] text-slate-500">Inovasi & Visi</span>
                </div>
                <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100">
                    <span class="text-[10px] font-bold text-blue-800 uppercase block">Conscientious</span>
                    <span class="text-base font-black text-blue-900 mt-0.5 block">88.00%</span>
                    <span class="text-[10px] text-slate-500">Disiplin Kas</span>
                </div>
                <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100">
                    <span class="text-[10px] font-bold text-blue-800 uppercase block">Extraversion</span>
                    <span class="text-base font-black text-blue-900 mt-0.5 block">75.00%</span>
                    <span class="text-[10px] text-slate-500">Jejaring Mitra</span>
                </div>
                <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100">
                    <span class="text-[10px] font-bold text-blue-800 uppercase block">Agreeable</span>
                    <span class="text-base font-black text-blue-900 mt-0.5 block">80.00%</span>
                    <span class="text-[10px] text-slate-500">Transparansi</span>
                </div>
                <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100 col-span-2 sm:col-span-1">
                    <span class="text-[10px] font-bold text-blue-800 uppercase block">Stability</span>
                    <span class="text-base font-black text-blue-900 mt-0.5 block">75.00%</span>
                    <span class="text-[10px] text-slate-500">Resiliensi Krisis</span>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-center gap-4">
                <a href="{{ route('wizard.completion') }}" 
                   class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition text-xs flex items-center gap-2">
                    Lanjut ke Ringkasan Status Formulir &rarr;
                </a>
            </div>
        </div>

    @else
        <!-- Active 20 Questions Wizard using Alpine.js (Gambar 19, 20, 21) -->
        <div x-data="{
            current: 1,
            total: 20,
            answers: {
                1: 5, 2: 4, 3: 5, 4: 5, 5: 4, 
                6: 4, 7: 5, 8: 4, 9: 5, 10: 4,
                11: 4, 12: 5, 13: 4, 14: 5, 15: 4,
                16: 4, 17: 5, 18: 4, 19: 5, 20: 5
            },
            next() {
                if (this.current < this.total) {
                    this.current++;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            },
            prev() {
                if (this.current > 1) {
                    this.current--;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }
        }" class="space-y-6">

            <!-- Progress Header (Gambar 19 & 20) -->
            <div class="space-y-2 pb-4 border-b border-slate-200">
                <div class="flex items-center justify-between text-xs">
                    <span class="font-bold text-blue-900 uppercase tracking-wider">
                        Asesmen Karakter Kewirausahaan (Big-Five Psychometrics)
                    </span>
                    <span class="font-extrabold text-blue-600" x-text="`Pertanyaan ${current} dari ${total} (${Math.round((current / total) * 100)}%)`"></span>
                </div>
                <!-- Dynamic Progress Bar -->
                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-2.5 rounded-full transition-all duration-300 ease-out" 
                         :style="`width: ${(current / total) * 100}%`"></div>
                </div>
            </div>

            <!-- Form Container -->
            <form method="POST" action="{{ route('wizard.save-character-assessment') }}" id="characterForm" class="space-y-8">
                @csrf

                <!-- Question Items -->
                @foreach($questions as $idx => $q)
                    <div x-show="current === {{ $idx }}" x-cloak class="space-y-6 animate-fadeIn">
                        
                        <!-- Question Badge & Title -->
                        <div class="p-6 rounded-2xl bg-gradient-to-br from-blue-50/70 via-slate-50 to-white border border-blue-100">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-600 text-white">
                                    Soal {{ $idx }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-400">Kode: {{ $q['code'] }}</span>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-relaxed">
                                &ldquo;{{ $q['text'] }}&rdquo;
                            </h3>
                            <p class="text-xs text-slate-500 mt-2">
                                Pilihlah opsi yang paling mencerminkan prinsip dan kebiasaan Anda dalam menjalankan kegiatan operasional usaha sehari-hari.
                            </p>
                        </div>

                        <!-- 5 Likert Scale Radio Options (Gambar 20 & 21) -->
                        <div class="space-y-3 pt-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Pilihan Tanggapan Anda:
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-5 gap-3">
                                
                                <!-- 1: Sangat Tidak Setuju -->
                                <label class="relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center group"
                                       :class="answers[{{ $idx }}] == 1 ? 'border-blue-600 bg-blue-50/50 shadow-sm ring-2 ring-blue-600/20' : 'border-slate-200 bg-white hover:border-slate-300'">
                                    <input type="radio" name="answers[{{ $idx }}]" value="1" x-model="answers[{{ $idx }}]" class="sr-only">
                                    <span class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-black transition mb-2"
                                          :class="answers[{{ $idx }}] == 1 ? 'border-blue-600 bg-blue-600 text-white' : 'border-slate-300 text-slate-600 group-hover:border-slate-400'">
                                        1
                                    </span>
                                    <span class="text-xs font-bold text-slate-800">Sangat Tidak Setuju</span>
                                </label>

                                <!-- 2: Tidak Setuju -->
                                <label class="relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center group"
                                       :class="answers[{{ $idx }}] == 2 ? 'border-blue-600 bg-blue-50/50 shadow-sm ring-2 ring-blue-600/20' : 'border-slate-200 bg-white hover:border-slate-300'">
                                    <input type="radio" name="answers[{{ $idx }}]" value="2" x-model="answers[{{ $idx }}]" class="sr-only">
                                    <span class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-black transition mb-2"
                                          :class="answers[{{ $idx }}] == 2 ? 'border-blue-600 bg-blue-600 text-white' : 'border-slate-300 text-slate-600 group-hover:border-slate-400'">
                                        2
                                    </span>
                                    <span class="text-xs font-bold text-slate-800">Tidak Setuju</span>
                                </label>

                                <!-- 3: Ragu-ragu / Netral -->
                                <label class="relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center group"
                                       :class="answers[{{ $idx }}] == 3 ? 'border-blue-600 bg-blue-50/50 shadow-sm ring-2 ring-blue-600/20' : 'border-slate-200 bg-white hover:border-slate-300'">
                                    <input type="radio" name="answers[{{ $idx }}]" value="3" x-model="answers[{{ $idx }}]" class="sr-only">
                                    <span class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-black transition mb-2"
                                          :class="answers[{{ $idx }}] == 3 ? 'border-blue-600 bg-blue-600 text-white' : 'border-slate-300 text-slate-600 group-hover:border-slate-400'">
                                        3
                                    </span>
                                    <span class="text-xs font-bold text-slate-800">Netral / Ragu</span>
                                </label>

                                <!-- 4: Setuju -->
                                <label class="relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center group"
                                       :class="answers[{{ $idx }}] == 4 ? 'border-blue-600 bg-blue-50/50 shadow-sm ring-2 ring-blue-600/20' : 'border-slate-200 bg-white hover:border-slate-300'">
                                    <input type="radio" name="answers[{{ $idx }}]" value="4" x-model="answers[{{ $idx }}]" class="sr-only">
                                    <span class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-black transition mb-2"
                                          :class="answers[{{ $idx }}] == 4 ? 'border-blue-600 bg-blue-600 text-white' : 'border-slate-300 text-slate-600 group-hover:border-slate-400'">
                                        4
                                    </span>
                                    <span class="text-xs font-bold text-slate-800">Setuju</span>
                                </label>

                                <!-- 5: Sangat Setuju -->
                                <label class="relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center group"
                                       :class="answers[{{ $idx }}] == 5 ? 'border-blue-600 bg-blue-50/50 shadow-sm ring-2 ring-blue-600/20' : 'border-slate-200 bg-white hover:border-slate-300'">
                                    <input type="radio" name="answers[{{ $idx }}]" value="5" x-model="answers[{{ $idx }}]" class="sr-only">
                                    <span class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-xs font-black transition mb-2"
                                          :class="answers[{{ $idx }}] == 5 ? 'border-blue-600 bg-blue-600 text-white' : 'border-slate-300 text-slate-600 group-hover:border-slate-400'">
                                        5
                                    </span>
                                    <span class="text-xs font-bold text-slate-800">Sangat Setuju</span>
                                </label>

                            </div>
                        </div>

                    </div>
                @endforeach

                <!-- Question Flow Action Buttons (Gambar 20 & 21) -->
                <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                    <button type="button" 
                            @click="prev()" 
                            x-show="current > 1" 
                            class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        &larr; Pertanyaan Sebelumnya
                    </button>
                    <div x-show="current === 1"></div>

                    <!-- Next Question (if current < 20) -->
                    <button type="button" 
                            @click="next()" 
                            x-show="current < total"
                            class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                        Pertanyaan Selanjutnya &rarr;
                    </button>

                    <!-- Final Submit (if current === 20) -->
                    <button type="submit" 
                            x-show="current === total"
                            class="px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-black rounded-xl shadow-lg shadow-emerald-600/25 transition duration-150 text-xs flex items-center gap-2">
                        ✓ Simpan & Selesaikan Asesmen Karakter
                    </button>
                </div>

            </form>

        </div>
    @endif

</div>
