<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Top Breadcrumb Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-purple-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <a href="{{ route('apply.choose') }}" class="hover:underline">Pilihan Pengajuan</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Bab 4.3: Non-Cash Loan</span>
                    </div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Form Pengajuan Penjaminan Non-Cash Loan</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Penerbitan Surety Bond & Kontra Bank Garansi tanpa agunan tunai 100% berbasis Sertifikat Rating SRI.</p>
                </div>

                <a href="{{ route('apply.choose') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition">
                    &larr; Ganti Jalur
                </a>
            </div>

            <!-- Pre-filled Debtor & Rating Summary Box (Gambar 36) -->
            <div class="p-6 rounded-3xl bg-gradient-to-r from-purple-900 via-indigo-900 to-slate-900 text-white shadow-md flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-purple-400/20 text-purple-300 border border-purple-400/30">
                        Suretyship & Bank Garansi
                    </span>
                    <h3 class="text-lg font-black text-white">{{ $user->business->business_name ?? 'PT Maju Bersama Sejahtera' }}</h3>
                    <p class="text-xs text-purple-100/90">Pemohon: <strong>{{ $user->profile->full_name ?? $user->name }}</strong> &bull; NIK: {{ $user->profile->id_card_number ?? '123848484939020' }}</p>
                </div>
                <div class="text-left sm:text-right bg-white/10 backdrop-blur-sm p-3.5 rounded-2xl border border-white/15 shrink-0">
                    <span class="text-[10px] uppercase font-bold text-purple-200 block">Sertifikat Rating SRI</span>
                    <span class="text-xl font-black text-white block">{{ $scoring->rating_grade }} (Skor {{ $scoring->credit_score }})</span>
                    <span class="text-[10px] text-purple-300 font-semibold block">Express Approval 1-2 Hari</span>
                </div>
            </div>

            <!-- Form Card (Gambar 37 - 38) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <form method="POST" action="{{ route('apply.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="submission_track" value="non_cash_loan">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Pilihan Lembaga Penerbit -->
                        <div class="md:col-span-2">
                            <label for="partner_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Pilih Lembaga Penjaminan / Bank Penerbit Garansi
                            </label>
                            <select id="partner_id" name="partner_id" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-3 text-xs text-slate-900 focus:border-purple-600 focus:bg-white focus:ring-2 focus:ring-purple-600/20 transition">
                                @foreach($partners as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->name }} ({{ $p->code }}) &bull; Kategori: {{ $p->category }} &bull; Rate Service: {{ $p->interest_rate_min }}% - {{ $p->interest_rate_max }}%
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jenis Instrumen Non-Cash Loan -->
                        <div>
                            <label for="selected_product_type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Jenis Instrumen Garansi / Surety Bond
                            </label>
                            <select id="selected_product_type" name="selected_product_type" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-purple-600 focus:bg-white focus:ring-2 focus:ring-purple-600/20 transition">
                                <option value="Jaminan Pelaksanaan (Performance Bond)">Jaminan Pelaksanaan (Performance Bond)</option>
                                <option value="Jaminan Penawaran (Bid Bond)">Jaminan Penawaran (Bid / Tender Bond)</option>
                                <option value="Jaminan Uang Muka (Advance Payment Bond)">Jaminan Uang Muka (Advance Payment Bond)</option>
                                <option value="Jaminan Pemeliharaan (Maintenance Bond)">Jaminan Pemeliharaan (Maintenance Bond)</option>
                                <option value="Kontra Bank Garansi (Counter Guarantee)">Kontra Bank Garansi (Counter Guarantee)</option>
                                <option value="Customs Bond (Kepabeanan)">Customs Bond (Kepabeanan Bea Cukai)</option>
                            </select>
                        </div>

                        <!-- Nilai Penjaminan Non-Cash Loan -->
                        <div>
                            <label for="loan_amount" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nilai Jaminan yang Dimohon (Rp)
                            </label>
                            <input type="number" id="loan_amount" name="loan_amount" required value="500000000" min="10000000" step="1000000" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-purple-600 focus:bg-white focus:ring-2 focus:ring-purple-600/20 transition">
                            <span class="text-[11px] text-slate-400 mt-1 block">Biasanya 5% - 20% dari nilai kontrak pengadaan</span>
                        </div>

                        <!-- Nama Obligee (Pemilik Proyek / Pemberi Kerja) -->
                        <div>
                            <label for="selected_product_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nama Obligee (Pemberi Kerja / Pemilik Proyek)
                            </label>
                            <input type="text" id="selected_product_name" name="selected_product_name" required value="PT Telekomunikasi Selular / BUMN Group" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-purple-600 focus:bg-white focus:ring-2 focus:ring-purple-600/20 transition">
                        </div>

                        <!-- Tenor / Masa Berlaku Jaminan -->
                        <div>
                            <label for="tenor_months" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Masa Berlaku Garansi (Bulan)
                            </label>
                            <select id="tenor_months" name="tenor_months" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-purple-600 focus:bg-white focus:ring-2 focus:ring-purple-600/20 transition">
                                <option value="3">3 Bulan (90 Hari Kalender)</option>
                                <option value="6" selected>6 Bulan (180 Hari Kalender)</option>
                                <option value="12">12 Bulan (1 Tahun Kalender)</option>
                                <option value="24">24 Bulan (2 Tahun Kalender)</option>
                            </select>
                        </div>

                        <!-- Rincian Proyek / Nomor Pengadaan -->
                        <div class="md:col-span-2">
                            <label for="loan_purpose" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Uraian Pekerjaan Proyek & No. Tender / SPK
                            </label>
                            <textarea id="loan_purpose" name="loan_purpose" rows="3" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-purple-600 focus:bg-white focus:ring-2 focus:ring-purple-600/20 transition" placeholder="Cantumkan nomor kontrak tender dan lingkup pekerjaan...">Pengadaan dan pemasangan suku cadang perangkat telekomunikasi serat optik tahap II No. Kontrak: SPK-TEL/2026/089 senilai total Rp 5.000.000.000.</textarea>
                        </div>

                    </div>

                    <!-- Submit Action Bar -->
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('apply.choose') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3.5 bg-purple-600 hover:bg-purple-700 active:bg-purple-800 text-white font-black rounded-xl shadow-lg shadow-purple-500/25 transition text-xs flex items-center gap-2">
                            <span>Kirim Pengajuan Non-Cash Loan (Tahap 6)</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
