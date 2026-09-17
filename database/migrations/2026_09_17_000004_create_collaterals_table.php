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
        Schema::create('collaterals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('business_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('collateral_type'); // Objek Agunan (Tanah & Bangunan, Kendaraan, Mesin, Resi Gudang, dll)
            $table->string('owner_name'); // Nama Pemilik Agunan
            $table->text('location'); // Lokasi Agunan
            $table->decimal('estimated_value', 15, 2); // Nilai Agunan
            $table->string('valuation_basis'); // Nilai Berdasarkan (NJOP, Harga Pasar, Jasa Penilai/Appraisal, Nilai Buku)
            $table->string('supporting_document_path')->nullable(); // Upload File Pendukung Agunan (SHM, BPKB, dll)
            $table->string('photo_path')->nullable(); // Upload Foto Agunan
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaterals');
    }
};
