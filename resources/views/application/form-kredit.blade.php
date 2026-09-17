<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Top Breadcrumb Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-blue-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <a href="{{ route('apply.choose') }}" class="hover:underline">Pilihan Pengajuan</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Bab 4.1: Kredit</span>
                    </div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Form Pengajuan Fasilitas Kredit (Bank Loan)</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Pengajuan fasilitas kredit modal kerja atau investasi kepada mitra bank dengan jaminan rating SRI (Grade {{ $scoring->rating_grade }} / {{ $scoring->credit_score }}).</p>
                </div>

                <a href="{{ route('apply.choose') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition">
                    &larr; Ganti Jalur
                </a>
            </div>

            <!-- Pre-filled Debtor & Rating Summary Box (Gambar 28) -->
            <div class="p-6 rounded-3xl bg-gradient-to-r from-[#1E40AF] to-indigo-900 text-white shadow-md flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-400/20 text-emerald-300 border border-emerald-400/30">
                        Profil Debitur Terverifikasi
                    </span>
                    <h3 class="text-lg font-black text-white">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}</h3>
                    <p class="text-xs text-blue-100/90">Pemohon: <strong>{{ $user->profile->full_name ?? $user->name }}</strong> &bull; NIK: {{ $user->profile->id_card_number ?? '123848484939020' }}</p>
                </div>
                <div class="text-left sm:text-right bg-white/10 backdrop-blur-sm p-3.5 rounded-2xl border border-white/15 shrink-0">
                    <span class="text-[10px] uppercase font-bold text-blue-200 block">Sertifikat Rating SRI</span>
                    <span class="text-xl font-black text-white block">{{ $scoring->rating_grade }} (Skor {{ $scoring->credit_score }})</span>
                    <span class="text-[10px] text-emerald-300 font-semibold block">SLIK Kol 1 - Lancar</span>
                </div>
            </div>

            <!-- Form Card (Gambar 29 - 32) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <form method="POST" action="{{ route('apply.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="submission_track" value="kredit">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Pilihan Bank Mitra -->
                        <div class="md:col-span-2">
                            <label for="partner_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Pilih Mitra Lembaga Perbankan
                            </label>
                            <select id="partner_id" name="partner_id" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-3 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                                @foreach($partners as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->name }} ({{ $p->code }}) &bull; Suku Bunga: {{ $p->interest_rate_min }}% - {{ $p->interest_rate_max }}% &bull; Maks Tenor: {{ $p->max_tenor_months }} Bulan
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nominal Plafon Pengajuan -->
                        <div>
                            <label for="loan_amount" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nominal Plafon Pengajuan (Rp)
                            </label>
                            <input type="number" id="loan_amount" name="loan_amount" required value="1500000000" min="10000000" step="1000000" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                            <span class="text-[11px] text-slate-400 mt-1 block">Rekomendasi Plafon SRI: Rp 1.500.000.000</span>
                        </div>

                        <!-- Tenor / Jangka Waktu -->
                        <div>
                            <label for="tenor_months" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Jangka Waktu (Tenor)
                            </label>
                            <select id="tenor_months" name="tenor_months" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                                <option value="12">12 Bulan (1 Tahun)</option>
                                <option value="24">24 Bulan (2 Tahun)</option>
                                <option value="36" selected>36 Bulan (3 Tahun - Rekomendasi)</option>
                                <option value="48">48 Bulan (4 Tahun)</option>
                                <option value="60">60 Bulan (5 Tahun)</option>
                            </select>
                        </div>

                        <!-- Jenis Produk Kredit -->
                        <div>
                            <label for="selected_product_type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Jenis Produk Kredit
                            </label>
                            <select id="selected_product_type" name="selected_product_type" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                                <option value="Kredit Modal Kerja (KMK)">Kredit Modal Kerja (KMK) Komersial</option>
                                <option value="Kredit Usaha Rakyat (KUR)">Kredit Usaha Rakyat (KUR) Mikro / Kecil</option>
                                <option value="Kredit Investasi Usaha (KI)">Kredit Investasi Usaha (KI)</option>
                                <option value="Supply Chain Financing">Supply Chain / Invoice Financing</option>
                            </select>
                        </div>

                        <!-- Wilayah Pengajuan -->
                        <div>
                            <label for="submission_region" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Wilayah / Kantor Cabang Pengajuan
                            </label>
                            <input type="text" id="submission_region" name="submission_region" value="DKI Jakarta & Tangerang Raya" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        </div>

                        <!-- Tujuan Penggunaan Kredit -->
                        <div class="md:col-span-2">
                            <label for="loan_purpose" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Rencana & Tujuan Penggunaan Fasilitas Kredit
                            </label>
                            <textarea id="loan_purpose" name="loan_purpose" rows="3" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition" placeholder="Jelaskan kebutuhan alokasi pembiayaan usaha Anda...">Penambahan persediaan stok suku cadang industri dan modal kerja pemenuhan purchase order pengadaan kawasan industri semester depan.</textarea>
                        </div>

                        <!-- Agunan Terhubung -->
                        <div class="md:col-span-2 p-4 rounded-2xl bg-blue-50/60 border border-blue-100 flex items-center justify-between text-xs">
                            <div>
                                <span class="font-bold text-blue-900 block">Agunan Terdaftar Otomatis:</span>
                                <span class="text-slate-600">Tanah & Bangunan Ruko Komersial (SHM Jessica Pangestu) &bull; Taksasi: Rp 2.500.000.000</span>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px]">
                                Coverage 166%
                            </span>
                        </div>

                    </div>

                    <!-- Submit Action Bar -->
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('apply.choose') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-black rounded-xl shadow-lg shadow-blue-500/25 transition text-xs flex items-center gap-2">
                            <span>Kirim Pengajuan ke Mitra Bank (Tahap 6)</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
