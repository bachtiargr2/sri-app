<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Top Breadcrumb Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-emerald-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <a href="{{ route('apply.choose') }}" class="hover:underline">Pilihan Pengajuan</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Bab 4.2: Penjaminan Cash Loan</span>
                    </div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Form Pengajuan Penjaminan Cash Loan</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Layanan penjaminan pinjaman modal kerja & investasi dari Lembaga Penjaminan Kredit (Jamkrindo / Jamkrida).</p>
                </div>

                <a href="{{ route('apply.choose') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition">
                    &larr; Ganti Jalur
                </a>
            </div>

            <!-- Pre-filled Debtor & Rating Summary Box (Gambar 33) -->
            <div class="p-6 rounded-3xl bg-gradient-to-r from-emerald-800 to-teal-950 text-white shadow-md flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-400/20 text-emerald-300 border border-emerald-400/30">
                        Penjaminan Terverifikasi SRI
                    </span>
                    <h3 class="text-lg font-black text-white">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}</h3>
                    <p class="text-xs text-emerald-100/90">Pemohon: <strong>{{ $user->profile->full_name ?? $user->name }}</strong> &bull; NIK: {{ $user->profile->id_card_number ?? '123848484939020' }}</p>
                </div>
                <div class="text-left sm:text-right bg-white/10 backdrop-blur-sm p-3.5 rounded-2xl border border-white/15 shrink-0">
                    <span class="text-[10px] uppercase font-bold text-emerald-200 block">Sertifikat Rating SRI</span>
                    <span class="text-xl font-black text-white block">{{ $scoring->rating_grade }} (Skor {{ $scoring->credit_score }})</span>
                    <span class="text-[10px] text-emerald-300 font-semibold block">Coverage Penjaminan 70-80%</span>
                </div>
            </div>

            <!-- Form Card (Gambar 34 - 35) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <form method="POST" action="{{ route('apply.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="submission_track" value="cash_loan">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Pilihan Lembaga Penjaminan -->
                        <div class="md:col-span-2">
                            <label for="partner_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Pilih Lembaga Penjaminan Kredit
                            </label>
                            <select id="partner_id" name="partner_id" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-3 text-xs text-slate-900 focus:border-emerald-600 focus:bg-white focus:ring-2 focus:ring-emerald-600/20 transition">
                                @foreach($partners as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->name }} ({{ $p->code }}) &bull; Fee IJP: {{ $p->interest_rate_min }}% - {{ $p->interest_rate_max }}% per tahun &bull; Maks Plafon: Rp {{ number_format($p->max_plafon, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nominal Penjaminan -->
                        <div>
                            <label for="loan_amount" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nilai Penjaminan Kredit yang Dimohon (Rp)
                            </label>
                            <input type="number" id="loan_amount" name="loan_amount" required value="1200000000" min="10000000" step="1000000" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-emerald-600 focus:bg-white focus:ring-2 focus:ring-emerald-600/20 transition">
                        </div>

                        <!-- Tenor Penjaminan -->
                        <div>
                            <label for="tenor_months" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Jangka Waktu Penjaminan (Tenor)
                            </label>
                            <select id="tenor_months" name="tenor_months" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-emerald-600 focus:bg-white focus:ring-2 focus:ring-emerald-600/20 transition">
                                <option value="12">12 Bulan (1 Tahun)</option>
                                <option value="24">24 Bulan (2 Tahun)</option>
                                <option value="36" selected>36 Bulan (3 Tahun - Standar Kontrak)</option>
                            </select>
                        </div>

                        <!-- Skema Produk Penjaminan -->
                        <div>
                            <label for="selected_product_type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Skema Produk Penjaminan
                            </label>
                            <select id="selected_product_type" name="selected_product_type" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-emerald-600 focus:bg-white focus:ring-2 focus:ring-emerald-600/20 transition">
                                <option value="Penjaminan Kredit Modal Kerja">Penjaminan Kredit Modal Kerja (KMK)</option>
                                <option value="Penjaminan Kredit Investasi">Penjaminan Kredit Investasi (KI)</option>
                                <option value="Penjaminan KUR">Penjaminan Kredit Usaha Rakyat (KUR)</option>
                                <option value="Penjaminan Resi Gudang Komoditas">Penjaminan Sistem Resi Gudang (SRG)</option>
                            </select>
                        </div>

                        <!-- Bank Penerima Jaminan (Kreditur Pokok) -->
                        <div>
                            <label for="selected_product_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Bank Pelaksana (Pemberi Pinjaman Pokok)
                            </label>
                            <input type="text" id="selected_product_name" name="selected_product_name" value="Bank BNI / Bank Mandiri (Kreditur)" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-emerald-600 focus:bg-white focus:ring-2 focus:ring-emerald-600/20 transition">
                        </div>

                        <!-- Tujuan Penjaminan -->
                        <div class="md:col-span-2">
                            <label for="loan_purpose" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Keterangan & Tujuan Penjaminan Kredit
                            </label>
                            <textarea id="loan_purpose" name="loan_purpose" rows="3" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-emerald-600 focus:bg-white focus:ring-2 focus:ring-emerald-600/20 transition" placeholder="Deskripsikan alasan pengajuan penjaminan...">Penguatan kapasitas jaminan (collateral enhancement) untuk pemenuhan fasilitas kredit modal kerja perbankan sebesar Rp 1.5 Miliar.</textarea>
                        </div>

                    </div>

                    <!-- Submit Action Bar -->
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('apply.choose') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-black rounded-xl shadow-lg shadow-emerald-500/25 transition text-xs flex items-center gap-2">
                            <span>Kirim Pengajuan ke Lembaga Penjaminan (Tahap 6)</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
