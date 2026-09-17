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
        Schema::create('credit_scorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('business_id')->nullable()->constrained()->cascadeOnDelete();
            
            // Sertifikat & Rating Utama (Bab 3.8 & 3.9)
            $table->string('certificate_id')->unique()->nullable(); // e.g. CRTYES1230001
            $table->integer('credit_score')->default(150); // Skala 150-950 (e.g. 740)
            $table->string('rating_grade', 10)->default('Bb'); // Aaa, Aa, Bb, B, Cc, C, D, E
            $table->text('rating_description')->nullable(); // e.g. "Kredit baik, risiko rendah."

            // Analisis 5C (Character, Capacity, Collateral, Capital, Condition)
            $table->decimal('score_5c_character', 5, 2)->default(0); // e.g. 30.00
            $table->decimal('score_5c_capacity', 5, 2)->default(0); // e.g. 10.00
            $table->decimal('score_5c_collateral', 5, 2)->default(0); // e.g. 13.00
            $table->decimal('score_5c_capital', 5, 2)->default(0); // e.g. 10.00
            $table->decimal('score_5c_condition', 5, 2)->default(0); // e.g. 12.00
            $table->decimal('score_5c_total', 5, 2)->default(0); // e.g. 75.00

            // Analisis 4P Penjaminan (Personality, Prospek, Produktivitas, Payment)
            $table->decimal('score_4p_personality', 5, 2)->default(0); // e.g. 21.50
            $table->decimal('score_4p_prospek', 5, 2)->default(0); // e.g. 10.00
            $table->decimal('score_4p_produktivitas', 5, 2)->default(0); // e.g. 28.88
            $table->decimal('score_4p_payment', 5, 2)->default(0); // e.g. 19.20
            $table->decimal('score_4p_total', 5, 2)->default(0); // e.g. 79.58

            // Psikogram Karakter Kewirausahaan (Big-Five Dimensions 0-100)
            $table->decimal('big5_openness', 5, 2)->default(0); // Keterbukaan untuk Pengalaman (Openness)
            $table->decimal('big5_conscientiousness', 5, 2)->default(0); // Ketelitian (Conscientiousness)
            $table->decimal('big5_extraversion', 5, 2)->default(0); // Ekstroversi (Extraversion)
            $table->decimal('big5_agreeableness', 5, 2)->default(0); // Keramahan (Agreeableness)
            $table->decimal('big5_neuroticism', 5, 2)->default(0); // Kestabilan Emosi (Neuroticism)
            $table->text('big5_summary')->nullable(); // Ringkasan deskripsi psikogram

            // Hasil Skoring Eksternal (SLIK OJK / IdScore)
            $table->string('slik_status')->default('1-Lancar'); // 1-Lancar, 2-DPK, 3-Kurang Lancar, 4-Diragukan, 5-Macet
            $table->integer('slik_score')->nullable();

            $table->text('summary_notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('scoring_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_scorings');
    }
};
