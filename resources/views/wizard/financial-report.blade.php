@include('wizard.layout', ['title' => 'Lengkapi Laporan Keuangan', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Top Sub-Navigation Tabs matching Gambar 12 & 13 -->
    <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-slate-200">
        <a href="{{ route('wizard.financial-report') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-sm">
            &bull; Laporan Keuangan
        </a>
        <a href="{{ route('wizard.collateral') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700">
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
            <h2 class="text-xl font-bold text-slate-900">Laporan Keuangan 3 Periode (Laba Rugi & Neraca)</h2>
            <p class="text-xs text-slate-500">Masukkan data historis 3 tahun buku untuk menganalisis tren pertumbuhan usaha (Capacity & Capital).</p>
        </div>
        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
            Tahap 3 dari 4
        </span>
    </div>

    <form method="POST" action="{{ route('wizard.save-financial-report') }}" class="space-y-8">
        @csrf

        @php
            $p1 = $reports->get(1); // Dec 2020
            $p2 = $reports->get(2); // Dec 2021
            $p3 = $reports->get(3); // Dec 2022
        @endphp

        <!-- 1. TABEL LAPORAN LABA / RUGI (Gambar 12) -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-blue-900 uppercase tracking-wider bg-blue-50 p-2.5 rounded-lg border border-blue-100">
                I. Laporan Laba / Rugi (Income Statement)
            </h3>

            <div class="overflow-x-auto border border-slate-200 rounded-xl shadow-sm">
                <table class="w-full text-xs text-left border-collapse">
                    <thead class="bg-slate-100 text-slate-700 font-bold border-b border-slate-200">
                        <tr>
                            <th class="p-3 w-2/5">Aktivitas</th>
                            <th class="p-3 text-center border-l border-slate-200">Dec 2022 (Terbaru)</th>
                            <th class="p-3 text-center border-l border-slate-200">Dec 2021</th>
                            <th class="p-3 text-center border-l border-slate-200">Dec 2020</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <!-- Header Group -->
                        <tr class="bg-slate-50 font-bold text-slate-800">
                            <td colspan="4" class="p-2.5">PENDAPATAN OPERASIONAL</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Pendapatan Operasional Pokok (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][operating_revenue]" value="{{ $p3->operating_revenue ?? 7400000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][operating_revenue]" value="{{ $p2->operating_revenue ?? 5800000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][operating_revenue]" value="{{ $p1->operating_revenue ?? 4500000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Pendapatan Operasional Lainnya (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][other_operating_revenue]" value="{{ $p3->other_operating_revenue ?? 180000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][other_operating_revenue]" value="{{ $p2->other_operating_revenue ?? 150000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][other_operating_revenue]" value="{{ $p1->other_operating_revenue ?? 120000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>

                        <!-- Beban Operasional -->
                        <tr class="bg-slate-50 font-bold text-slate-800">
                            <td colspan="4" class="p-2.5">BEBAN OPERASIONAL</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Beban Pokok Penjualan / Operasional Pokok (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][operational_expense]" value="{{ $p3->operational_expense ?? 5100000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][operational_expense]" value="{{ $p2->operational_expense ?? 4100000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][operational_expense]" value="{{ $p1->operational_expense ?? 3200000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Beban Tenaga Kerja (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][labor_expense]" value="{{ $p3->labor_expense ?? 900000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][labor_expense]" value="{{ $p2->labor_expense ?? 750000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][labor_expense]" value="{{ $p1->labor_expense ?? 600000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Beban Sewa & Pemeliharaan (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][rent_expense]" value="{{ $p3->rent_expense ?? 200000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][rent_expense]" value="{{ $p2->rent_expense ?? 180000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][rent_expense]" value="{{ $p1->rent_expense ?? 160000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Penyusutan / Amortisasi & Beban Lainnya (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][depreciation_expense]" value="{{ $p3->depreciation_expense ?? 130000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][depreciation_expense]" value="{{ $p2->depreciation_expense ?? 110000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][depreciation_expense]" value="{{ $p1->depreciation_expense ?? 85000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>

                        <!-- Total Laba Bersih -->
                        <tr class="bg-blue-50/70 font-bold text-blue-900 border-t-2 border-blue-200">
                            <td class="p-3">TOTAL LABA (RUGI) BERSIH TAHUN BERJALAN</td>
                            <td class="p-2 border-l border-blue-200"><input type="number" name="period[3][net_profit]" value="{{ $p3->net_profit ?? 850000000 }}" class="w-full text-right p-1.5 text-xs font-bold rounded border-blue-300 bg-white"></td>
                            <td class="p-2 border-l border-blue-200"><input type="number" name="period[2][net_profit]" value="{{ $p2->net_profit ?? 500000000 }}" class="w-full text-right p-1.5 text-xs font-bold rounded border-blue-300 bg-white"></td>
                            <td class="p-2 border-l border-blue-200"><input type="number" name="period[1][net_profit]" value="{{ $p1->net_profit ?? 340000000 }}" class="w-full text-right p-1.5 text-xs font-bold rounded border-blue-300 bg-white"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 2. TABEL LAPORAN POSISI KEUANGAN / NERACA (Gambar 13) -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-blue-900 uppercase tracking-wider bg-blue-50 p-2.5 rounded-lg border border-blue-100">
                II. Laporan Neraca / Posisi Keuangan (Balance Sheet)
            </h3>

            <div class="overflow-x-auto border border-slate-200 rounded-xl shadow-sm">
                <table class="w-full text-xs text-left border-collapse">
                    <thead class="bg-slate-100 text-slate-700 font-bold border-b border-slate-200">
                        <tr>
                            <th class="p-3 w-2/5">Posisi Keuangan</th>
                            <th class="p-3 text-center border-l border-slate-200">Dec 2022</th>
                            <th class="p-3 text-center border-l border-slate-200">Dec 2021</th>
                            <th class="p-3 text-center border-l border-slate-200">Dec 2020</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <!-- Aset -->
                        <tr class="bg-slate-50 font-bold text-slate-800">
                            <td colspan="4" class="p-2.5">ASET (AKTIVA)</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Kas & Setara Kas (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][cash]" value="{{ $p3->cash ?? 890000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][cash]" value="{{ $p2->cash ?? 620000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][cash]" value="{{ $p1->cash ?? 450000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Aset Lancar Lainnya (Piutang, Persediaan) (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][current_assets]" value="{{ $p3->current_assets ?? 1450000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][current_assets]" value="{{ $p2->current_assets ?? 1100000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][current_assets]" value="{{ $p1->current_assets ?? 850000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Aset Tetap (Nilai Buku Setelah Penyusutan) (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][acquisition_cost]" value="{{ $p3->acquisition_cost ?? 1875000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][acquisition_cost]" value="{{ $p2->acquisition_cost ?? 1570000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][acquisition_cost]" value="{{ $p1->acquisition_cost ?? 1350000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr class="bg-blue-50/50 font-bold text-blue-900 border-t border-slate-200">
                            <td class="p-2.5">TOTAL AKTIVA (ASET)</td>
                            <td class="p-2 border-l border-slate-200"><input type="number" name="period[3][total_assets]" value="{{ $p3->total_assets ?? 4400000000 }}" class="w-full text-right p-1.5 text-xs font-bold rounded border-blue-300 bg-white"></td>
                            <td class="p-2 border-l border-slate-200"><input type="number" name="period[2][total_assets]" value="{{ $p2->total_assets ?? 3440000000 }}" class="w-full text-right p-1.5 text-xs font-bold rounded border-blue-300 bg-white"></td>
                            <td class="p-2 border-l border-slate-200"><input type="number" name="period[1][total_assets]" value="{{ $p1->total_assets ?? 2750000000 }}" class="w-full text-right p-1.5 text-xs font-bold rounded border-blue-300 bg-white"></td>
                        </tr>

                        <!-- Kewajiban -->
                        <tr class="bg-slate-50 font-bold text-slate-800">
                            <td colspan="4" class="p-2.5">KEWAJIBAN & EKUITAS (PASIVA)</td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Kewajiban Lancar & Utang Jangka Pendek (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][short_term_liabilities]" value="{{ $p3->short_term_liabilities ?? 650000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][short_term_liabilities]" value="{{ $p2->short_term_liabilities ?? 580000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][short_term_liabilities]" value="{{ $p1->short_term_liabilities ?? 450000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Kewajiban Jangka Panjang / Lain-lain (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][other_liabilities]" value="{{ $p3->other_liabilities ?? 300000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][other_liabilities]" value="{{ $p2->other_liabilities ?? 260000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][other_liabilities]" value="{{ $p1->other_liabilities ?? 200000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Modal Disetor & Ekuitas (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][share_capital]" value="{{ $p3->share_capital ?? 1500000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][share_capital]" value="{{ $p2->share_capital ?? 1500000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][share_capital]" value="{{ $p1->share_capital ?? 1500000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                        <tr>
                            <td class="p-2.5 pl-6 text-slate-600">Saldo Laba Ditahan & Berjalan (Rp)</td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[3][retained_earnings]" value="{{ $p3->retained_earnings ?? 1950000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[2][retained_earnings]" value="{{ $p2->retained_earnings ?? 1100000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                            <td class="p-2 border-l border-slate-100"><input type="number" name="period[1][retained_earnings]" value="{{ $p1->retained_earnings ?? 600000000 }}" class="w-full text-right p-1.5 text-xs rounded border-slate-200 bg-slate-50 focus:bg-white"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Catatan Lainnya -->
        <div>
            <label for="notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Catatan Laporan Keuangan Lainnya</label>
            <input type="text" id="notes" name="notes" placeholder="Contoh: Laporan keuangan audited KAP Tanubrata Sutanto & Rekan" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white">
        </div>

        <!-- Submit Button (Gambar 13: Save Changes) -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100">
            <a href="{{ route('wizard.business-profile') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                &larr; Profil Usaha
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                Simpan & Lanjutkan ke Data Agunan &rarr;
            </button>
        </div>
    </form>
</div>
