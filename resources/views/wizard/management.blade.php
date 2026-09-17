@include('wizard.layout', ['title' => 'Profil Manajemen', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Top Sub-Navigation Tabs matching Gambar 15 -->
    <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-slate-200">
        <a href="{{ route('wizard.financial-report') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Laporan Keuangan
        </a>
        <a href="{{ route('wizard.collateral') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
            &bull; Data Agunan
        </a>
        <a href="{{ route('wizard.management') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm">
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

    <!-- Header Title -->
    <div>
        <h2 class="text-xl font-bold text-slate-900">Profil Manajemen (Management Profile)</h2>
        <p class="text-xs text-slate-500 mt-1">Evaluasi tata kelola, reputasi manajerial, rekam jejak direksi/komisaris, dan kepatuhan finansial calon terjamin.</p>
    </div>

    <!-- Form Profil Manajemen (Gambar 15 & Tabel 8) -->
    <form method="POST" action="{{ route('wizard.save-management') }}" class="space-y-8 pt-2">
        @csrf

        <!-- 1. Profil Calon Terjamin -->
        <div class="space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center font-bold text-xs">1</span>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Profil Calon Terjamin / Perusahaan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Kinerja Sehat -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Perusahaan Memiliki Kinerja Sehat</label>
                    <select name="mgt[MGT_01]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_01'] ?? 5) == 5 ? 'selected' : '' }}>Sangat Sehat (Pertumbuhan Laba & Arus Kas Positif)</option>
                        <option value="4" {{ ($savedAnswers['MGT_01'] ?? null) == 4 ? 'selected' : '' }}>Sehat (Operasional Stabil)</option>
                        <option value="3" {{ ($savedAnswers['MGT_01'] ?? null) == 3 ? 'selected' : '' }}>Cukup Sehat</option>
                        <option value="2" {{ ($savedAnswers['MGT_01'] ?? null) == 2 ? 'selected' : '' }}>Kurang Sehat</option>
                    </select>
                </div>

                <!-- Pencatatan Keuangan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pencatatan & Pembukuan Keuangan</label>
                    <select name="mgt[MGT_02]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_02'] ?? 5) == 5 ? 'selected' : '' }}>Diaudit oleh Akuntan Publik (KAP Independen)</option>
                        <option value="4" {{ ($savedAnswers['MGT_02'] ?? null) == 4 ? 'selected' : '' }}>Laporan Keuangan Standar SAK ETAP / SAK EMKM</option>
                        <option value="3" {{ ($savedAnswers['MGT_02'] ?? null) == 3 ? 'selected' : '' }}>Pencatatan Internal Software Akuntansi</option>
                        <option value="2" {{ ($savedAnswers['MGT_02'] ?? null) == 2 ? 'selected' : '' }}>Pencatatan Buku Kas Sederhana</option>
                    </select>
                </div>

                <!-- DHN Perusahaan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Daftar Hitam Nasional (DHN BI / OJK)</label>
                    <select name="mgt[MGT_03]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_03'] ?? 5) == 5 ? 'selected' : '' }}>Tidak Terdaftar (Bersih 100%)</option>
                        <option value="1" {{ ($savedAnswers['MGT_03'] ?? null) == 1 ? 'selected' : '' }}>Terdaftar dalam DHN</option>
                    </select>
                </div>

                <!-- Modal Disetor -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jumlah Modal Disetor</label>
                    <select name="mgt[MGT_04]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_04'] ?? 5) == 5 ? 'selected' : '' }}>&ge; Rp 500.000.000 (Sesuai Akta Pendirian)</option>
                        <option value="4" {{ ($savedAnswers['MGT_04'] ?? null) == 4 ? 'selected' : '' }}>Rp 250.000.000 s.d &lt; Rp 500.000.000</option>
                        <option value="3" {{ ($savedAnswers['MGT_04'] ?? null) == 3 ? 'selected' : '' }}>&lt; Rp 250.000.000</option>
                    </select>
                </div>

                <!-- Komposisi Saham -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Komposisi Kepemilikan Saham</label>
                    <select name="mgt[MGT_05]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_05'] ?? 5) == 5 ? 'selected' : '' }}>Mayoritas Pendiri / Pengelola Utama (&gt; 51% Saham)</option>
                        <option value="4" {{ ($savedAnswers['MGT_05'] ?? null) == 4 ? 'selected' : '' }}>Struktur Saham Korporasi / Kemitraan Strategis Domestik</option>
                        <option value="3" {{ ($savedAnswers['MGT_05'] ?? null) == 3 ? 'selected' : '' }}>Kepemilikan Tersebar Tanpa Pengendali Tunggal</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 2. Dewan Direksi & Komisaris -->
        <div class="space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center font-bold text-xs">2</span>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Rekam Jejak Direksi & Dewan Komisaris</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- DHN Direksi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status DHN Direksi</label>
                    <select name="mgt[MGT_DIR_01]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_DIR_01'] ?? 5) == 5 ? 'selected' : '' }}>Tidak Terdaftar dalam DHN (Bersih)</option>
                        <option value="1" {{ ($savedAnswers['MGT_DIR_01'] ?? null) == 1 ? 'selected' : '' }}>Terdaftar dalam DHN</option>
                    </select>
                </div>

                <!-- Pengalaman Direksi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pengalaman Kerja Direksi di Bidang Usaha Terkait</label>
                    <select name="mgt[MGT_DIR_02]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_DIR_02'] ?? 5) == 5 ? 'selected' : '' }}>Lebih dari 5 Tahun (Sangat Berpengalaman)</option>
                        <option value="4" {{ ($savedAnswers['MGT_DIR_02'] ?? null) == 4 ? 'selected' : '' }}>2 Tahun s.d 5 Tahun</option>
                        <option value="3" {{ ($savedAnswers['MGT_DIR_02'] ?? null) == 3 ? 'selected' : '' }}>Kurang dari 2 Tahun</option>
                    </select>
                </div>

                <!-- DHN Dewan Komisaris -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status DHN Dewan Komisaris</label>
                    <select name="mgt[MGT_KOM_01]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_KOM_01'] ?? 5) == 5 ? 'selected' : '' }}>Tidak Terdaftar dalam DHN (Bersih)</option>
                        <option value="1" {{ ($savedAnswers['MGT_KOM_01'] ?? null) == 1 ? 'selected' : '' }}>Terdaftar dalam DHN</option>
                    </select>
                </div>

                <!-- Hubungan Kelembagaan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Hubungan Kelembagaan / Lama Menjadi Nasabah Bank</label>
                    <select name="mgt[MGT_REL_01]" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                        <option value="5" {{ ($savedAnswers['MGT_REL_01'] ?? 5) == 5 ? 'selected' : '' }}>&gt; 3 Tahun (Nasabah Setia / Riwayat Baik)</option>
                        <option value="4" {{ ($savedAnswers['MGT_REL_01'] ?? null) == 4 ? 'selected' : '' }}>1 s.d 3 Tahun</option>
                        <option value="3" {{ ($savedAnswers['MGT_REL_01'] ?? null) == 3 ? 'selected' : '' }}>Nasabah Baru (&lt; 1 Tahun)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
            <a href="{{ route('wizard.collateral') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                &larr; Data Agunan
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                Simpan & Lanjutkan ke Prospek Bisnis &rarr;
            </button>
        </div>
    </form>
</div>
