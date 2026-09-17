<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('business_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('period_year'); // e.g. "Dec 2020", "Dec 2021", "Dec 2022"
            $table->unsignedTinyInteger('period_order')->default(1); // 1, 2, 3

            // Laporan Laba / Rugi (Income Statement)
            $table->decimal('operating_revenue', 15, 2)->default(0); // Pendapatan Operasional
            $table->decimal('other_operating_revenue', 15, 2)->default(0); // Pendapatan Operasional Lainnya
            $table->decimal('total_operating_revenue', 15, 2)->default(0); // Jumlah Pendapatan Operasional
            
            $table->decimal('operational_expense', 15, 2)->default(0); // Beban Operasional Pokok
            $table->decimal('labor_expense', 15, 2)->default(0); // Beban Tenaga Kerja
            $table->decimal('training_expense', 15, 2)->default(0); // Pendidikan & Pelatihan
            $table->decimal('rent_expense', 15, 2)->default(0); // Beban Sewa
            $table->decimal('promotion_expense', 15, 2)->default(0); // Promosi
            $table->decimal('tax_expense', 15, 2)->default(0); // Pajak-Pajak
            $table->decimal('maintenance_expense', 15, 2)->default(0); // Beban Pemeliharaan & Perbaikan
            $table->decimal('depreciation_expense', 15, 2)->default(0); // Penyusutan / Amortisasi
            $table->decimal('admin_general_expense', 15, 2)->default(0); // Administrasi Umum Barang & Jasa
            $table->decimal('other_operating_expense', 15, 2)->default(0); // Beban Operasional Lainnya
            $table->decimal('net_operating_income', 15, 2)->default(0); // Pendapatan Operasional Bersih

            $table->decimal('non_operating_revenue', 15, 2)->default(0); // Pendapatan Non Operasional
            $table->decimal('non_operating_expense', 15, 2)->default(0); // Beban Non Operasional
            $table->decimal('net_profit', 15, 2)->default(0); // Total Laba (Rugi) Bersih Tahun Berjalan

            // Laporan Posisi Keuangan / Neraca (Balance Sheet)
            // Aset Lancar
            $table->decimal('cash', 15, 2)->default(0); // Kas
            $table->decimal('net_cash', 15, 2)->default(0); // Net Cash
            $table->decimal('current_assets', 15, 2)->default(0); // Aset Lancar Lainnya
            $table->decimal('total_current_assets', 15, 2)->default(0); // Jumlah Aset Lancar

            // Aset Tetap
            $table->decimal('acquisition_cost', 15, 2)->default(0); // Harga Perolehan
            $table->decimal('accumulated_depreciation', 15, 2)->default(0); // Akumulasi Penyusutan
            $table->decimal('total_fixed_assets', 15, 2)->default(0); // Jumlah Aset Tetap
            $table->decimal('other_assets', 15, 2)->default(0); // Aset Lainnya
            $table->decimal('total_assets', 15, 2)->default(0); // TOTAL AKTIVA

            // Kewajiban (Liabilities)
            $table->decimal('short_term_liabilities', 15, 2)->default(0); // Kewajiban Segera
            $table->decimal('other_liabilities', 15, 2)->default(0); // Kewajiban Lain-lain
            $table->decimal('total_liabilities', 15, 2)->default(0); // Jumlah Kewajiban

            // Ekuitas (Equity)
            $table->decimal('share_capital', 15, 2)->default(0); // Modal Saham
            $table->decimal('paid_in_capital', 15, 2)->default(0); // Dana Setoran Modal
            $table->decimal('retained_earnings', 15, 2)->default(0); // Laba Ditahan
            $table->decimal('current_year_earnings', 15, 2)->default(0); // Laba Periode Berjalan
            $table->decimal('total_equity', 15, 2)->default(0); // Jumlah Ekuitas
            $table->decimal('total_liabilities_and_equity', 15, 2)->default(0); // TOTAL PASIVA

            $table->text('notes')->nullable(); // Catatan lainnya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
