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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('business_type', ['perorangan', 'badan_hukum'])->default('badan_hukum');
            $table->string('business_name');
            $table->year('established_year')->nullable();
            $table->string('legal_form')->nullable(); // PT, CV, UD, Koperasi, Lainnya
            $table->text('business_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('social_media')->nullable();
            $table->string('deed_establishment_number')->nullable(); // No Akta Pendirian
            $table->string('deed_amendment_number')->nullable(); // No Akta Perubahan Terakhir
            $table->string('npwp')->nullable(); // NPWP Usaha
            $table->string('main_director')->nullable(); // Direktur Utama
            $table->text('other_directors')->nullable(); // Direktur Lainnya
            $table->string('main_commissioner')->nullable(); // Komisaris Utama
            $table->text('other_commissioners')->nullable(); // Komisaris Lainnya
            $table->integer('employee_count')->default(0);
            $table->string('business_classification')->nullable();
            $table->string('revenue_range')->nullable(); // Range Omzet Usaha
            $table->text('business_description')->nullable(); // Deskripsi Usaha dan Produk
            $table->text('product_permits')->nullable(); // Perizinan Produk (izin edar, produksi, dll)
            $table->boolean('has_giro_deficit')->default(false); // Pernah mengalami kekurangan dana giro saat cek/bilyet
            
            // Lampiran Dokumen
            $table->string('doc_place_photo_path')->nullable(); // Upload Dokumentasi Tempat Usaha
            $table->string('doc_product_photo_path')->nullable(); // Upload Dokumentasi Produk
            $table->string('doc_deed_nib_path')->nullable(); // Upload Akta / NIB

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
