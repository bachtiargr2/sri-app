@include('wizard.layout', ['title' => 'Data Agunan (Collateral)', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Top Sub-Navigation Tabs matching Gambar 14 -->
    <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-slate-200">
        <a href="{{ route('wizard.financial-report') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Laporan Keuangan
        </a>
        <a href="{{ route('wizard.collateral') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm">
            &bull; Data Agunan
        </a>
        <a href="{{ route('wizard.management') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Profil Manajemen
        </a>
        <a href="{{ route('wizard.prospect') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Prospek
        </a>
        <a href="{{ route('wizard.productivity') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Produktivitas
        </a>
        <a href="{{ route('wizard.payment') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Payment & RAC
        </a>
    </div>

    <!-- Title Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Data Agunan (Collateral)</h2>
            <p class="text-xs text-slate-500">Informasi nilai aset jaminan untuk pemenuhan kecukupan plafon kredit / penjaminan (100-120%).</p>
        </div>
    </div>

    <!-- List Existing Collaterals (if any) -->
    @if($collaterals->count() > 0)
        <div class="space-y-3">
            <h4 class="text-xs font-bold text-slate-700 uppercase">Daftar Agunan Terdaftar:</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($collaterals as $c)
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex justify-between items-center text-xs">
                        <div>
                            <p class="font-bold text-slate-900">{{ $c->collateral_type }}</p>
                            <p class="text-[11px] text-slate-500 mt-0.5">{{ $c->location }} (An. {{ $c->owner_name }})</p>
                            <span class="inline-block mt-1 text-[10px] bg-blue-50 text-blue-700 font-bold px-2 py-0.5 rounded border border-blue-200">
                                {{ $c->valuation_basis }}
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="font-black text-sm text-blue-900">Rp {{ number_format($c->estimated_value, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Form Input Agunan Baru (Gambar 14) -->
    <form method="POST" action="{{ route('wizard.save-collateral') }}" class="space-y-6 pt-2">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Objek Agunan -->
            <div>
                <label for="collateral_type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Objek Agunan</label>
                <select id="collateral_type" name="collateral_type" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                    <option value="Tanah & Bangunan Ruko Komersial">Tanah & Bangunan Ruko / Tempat Usaha</option>
                    <option value="Tanah & Rumah Tinggal (SHM)">Tanah & Rumah Tinggal (SHM)</option>
                    <option value="Kendaraan Operasional / Truk">Kendaraan Operasional / Truk (BPKB)</option>
                    <option value="Mesin & Peralatan Industri">Mesin & Peralatan Industri</option>
                    <option value="Resi Gudang Komoditas">Resi Gudang Komoditas</option>
                    <option value="Deposito Berjangka / Cash Collateral">Deposito Berjangka / Cash Collateral</option>
                </select>
            </div>

            <!-- Nama Pemilik Agunan -->
            <div>
                <label for="owner_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Pemilik Sesuai Bukti Hak</label>
                <input type="text" id="owner_name" name="owner_name" required value="Jessica Pangestu" placeholder="Nama pemilik sah agunan" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Lokasi Agunan -->
            <div>
                <label for="location" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Lokasi Agunan Lengkap</label>
                <input type="text" id="location" name="location" required value="Komplek Ruko Golden Boulevard Blok S-10, BSD City, Tangerang Selatan" placeholder="Alamat lokasi agunan berada" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Nilai Agunan -->
            <div>
                <label for="estimated_value" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Taksasi Nilai Agunan (Rp)</label>
                <input type="number" id="estimated_value" name="estimated_value" required value="2500000000" placeholder="Nominal Rp" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Nilai Berdasarkan (Radio: NJOP, Harga Pasar, Appraisal) -->
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nilai Berdasarkan</label>
                <div class="flex flex-wrap gap-6 text-xs">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="valuation_basis" value="NJOP" class="text-blue-600">
                        <span>NJOP (Nilai Jual Objek Pajak)</span>
                    </label>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="valuation_basis" value="Harga Pasar" class="text-blue-600">
                        <span>Harga Pasar Wajar</span>
                    </label>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="valuation_basis" value="Jasa Penilai (Appraisal)" checked class="text-blue-600">
                        <span class="font-bold text-slate-900">Jasa Penilai (Appraisal KJPP)</span>
                    </label>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="valuation_basis" value="Nilai Buku" class="text-blue-600">
                        <span>Nilai Buku</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Upload Buttons (Gambar 14) -->
        <div class="flex flex-wrap gap-3 pt-2">
            <button type="button" class="py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload File Pendukung Agunan (SHM / BPKB)
            </button>
            <button type="button" class="py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload Foto Agunan
            </button>
        </div>

        <!-- Submit Buttons (Gambar 14: Tambahkan Agunan Lainnya / Save Changes) -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-100">
            <button type="submit" name="add_more" value="1" class="w-full sm:w-auto px-6 py-2.5 rounded-xl border border-blue-200 text-blue-600 hover:bg-blue-50 text-xs font-bold transition">
                + Tambahkan Agunan Lainnya
            </button>

            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <a href="{{ route('wizard.financial-report') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                    &larr; Laporan Keuangan
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                    Simpan & Lanjutkan ke Profil Manajemen &rarr;
                </button>
            </div>
        </div>
    </form>
</div>
