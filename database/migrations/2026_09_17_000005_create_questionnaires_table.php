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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('category', [
                'management_profile',       // Profil Manajemen (Kinerja sehat, Transparansi, DHN, Direksi/Komisaris, Hubungan Bank)
                'business_prospect',        // Prospek Bisnis (Kepemilikan aset, Wilayah pasar, Jumlah cabang, Diversifikasi produk)
                'productivity',             // Produktivitas & Rasio (Modal sendiri/aset, DER, ROA, ROE, Cash Ratio)
                'payment',                  // Payment, DSR & RAC (Persentase laba/utang, Pertumbuhan kas/utang/modal, RAC)
                'entrepreneurship_character' // Karakter Kewirausahaan (20+ Soal Likert 1-5 Big Five)
            ]);
            $table->string('question_code'); // e.g. MGT_01, PROS_01, PROD_01, PAY_01, BIG5_01
            $table->text('question_text');
            $table->decimal('score_value', 8, 2)->default(0); // Nilai/Bobot atau skala 1-5
            $table->string('selected_option')->nullable(); // Jawaban teks/pilihan parameter
            $table->text('additional_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
