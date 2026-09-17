@include('wizard.layout', ['title' => 'Prospek Bisnis', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Top Sub-Navigation Tabs matching Gambar 16 -->
    <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-slate-200">
        <a href="{{ route('wizard.financial-report') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Laporan Keuangan
        </a>
        <a href="{{ route('wizard.collateral') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Data Agunan
        </a>
        <a href="{{ route('wizard.management') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Profil Manajemen
        </a>
        <a href="{{ route('wizard.prospect') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm">
            &bull; Prospek
        </a>
        <a href="{{ route('wizard.productivity') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Produktivitas
        </a>
        <a href="{{ route('wizard.payment') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Payment & RAC
        </a>
    </div>

    <!-- Header Title -->
    <div>
        <h2 class="text-xl font-bold text-slate-900">Prospek Bisnis (Business Prospect)</h2>
        <p class="text-xs text-slate-500 mt-1">Penilaian prospek masa depan, stabilitas aset operasional, jangkauan pasar, dan diversifikasi produk usaha.</p>
    </div>

    <!-- Form Prospek Bisnis (Gambar 16 & Tabel 9) -->
    <form method="POST" action="{{ route('wizard.save-prospect') }}" class="space-y-8 pt-2">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kepemilikan Aset Operasional -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    1. Status Kepemilikan Tempat / Aset Usaha
                </label>
                <p class="text-[11px] text-slate-500">Legalitas tempat usaha menentukan keberlanjutan operasional jangka panjang.</p>
                <select name="pros[PROS_01]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                    <option value="5" {{ ($savedAnswers['PROS_01'] ?? 5) == 5 ? 'selected' : '' }}>Milik Sendiri (SHM / SHGB Resmi atas nama Badan Usaha/Pemilik)</option>
                    <option value="4" {{ ($savedAnswers['PROS_01'] ?? null) == 4 ? 'selected' : '' }}>Sewa Jangka Panjang (&ge; 5 Tahun dengan Kontrak Resmi)</option>
                    <option value="3" {{ ($savedAnswers['PROS_01'] ?? null) == 3 ? 'selected' : '' }}>Sewa Tahunan (1 s.d &lt; 5 Tahun)</option>
                    <option value="2" {{ ($savedAnswers['PROS_01'] ?? null) == 2 ? 'selected' : '' }}>Sewa Bulanan / Tempat Menumpang</option>
                </select>
            </div>

            <!-- Wilayah Pasar -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    2. Jangkauan Wilayah Pemasaran
                </label>
                <p class="text-[11px] text-slate-500">Cakupan distribusi penjualan produk atau jasa perusahaan.</p>
                <select name="pros[PROS_02]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                    <option value="5" {{ ($savedAnswers['PROS_02'] ?? 5) == 5 ? 'selected' : '' }}>Pasar Nasional (&gt; 3 Provinsi) / Ekspor Mancanegara</option>
                    <option value="4" {{ ($savedAnswers['PROS_02'] ?? null) == 4 ? 'selected' : '' }}>Pasar Regional Antar Kota / Dalam 1 Provinsi Luas</option>
                    <option value="3" {{ ($savedAnswers['PROS_02'] ?? null) == 3 ? 'selected' : '' }}>Pasar Lokal (Tingkat Kota / Kabupaten Domisili)</option>
                </select>
            </div>

            <!-- Jumlah Cabang / Titik Penjualan -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    3. Jumlah Cabang / Titik Outlet / Agen Distribusi
                </label>
                <p class="text-[11px] text-slate-500">Jumlah jaringan gerai fisik atau distributor resmi yang aktif.</p>
                <select name="pros[PROS_03]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                    <option value="5" {{ ($savedAnswers['PROS_03'] ?? 5) == 5 ? 'selected' : '' }}>Lebih dari 5 Cabang / Titik Distribusi</option>
                    <option value="4" {{ ($savedAnswers['PROS_03'] ?? null) == 4 ? 'selected' : '' }}>2 sampai 5 Cabang / Titik Penjualan</option>
                    <option value="3" {{ ($savedAnswers['PROS_03'] ?? null) == 3 ? 'selected' : '' }}>1 Kantor / Toko Tunggal (Pusat)</option>
                </select>
            </div>

            <!-- Diversifikasi Produk -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    4. Pengembangan & Diversifikasi Varian Produk
                </label>
                <p class="text-[11px] text-slate-500">Kesiapan usaha terhadap fluktuasi permintaan produk spesifik.</p>
                <select name="pros[PROS_04]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                    <option value="5" {{ ($savedAnswers['PROS_04'] ?? 5) == 5 ? 'selected' : '' }}>&gt; 3 Varian / Kategori Produk Unggulan Komplementer</option>
                    <option value="4" {{ ($savedAnswers['PROS_04'] ?? null) == 4 ? 'selected' : '' }}>2 s.d 3 Varian Produk</option>
                    <option value="3" {{ ($savedAnswers['PROS_04'] ?? null) == 3 ? 'selected' : '' }}>1 Jenis Produk Tunggal</option>
                </select>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
            <a href="{{ route('wizard.management') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                &larr; Profil Manajemen
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                Simpan & Lanjutkan ke Produktivitas & Rasio &rarr;
            </button>
        </div>
    </form>
</div>
