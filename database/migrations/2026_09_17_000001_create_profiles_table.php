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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('position')->nullable(); // e.g. Direktur Utama, Pemilik
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('existing_scoring_value')->nullable(); // Nilai scoring awal
            $table->string('scoring_certificate_path')->nullable(); // Upload Sertifikat Credit Skoring
            $table->string('id_card_number')->nullable(); // No KTP / NIK
            $table->string('birth_place_date')->nullable(); // Tempat, Tanggal Lahir
            $table->string('npwp')->nullable(); // No NPWP Pribadi
            $table->text('address')->nullable(); // Alamat Lengkap
            $table->string('city')->nullable(); // Kota / Kabupaten
            $table->string('province')->nullable(); // Provinsi
            $table->string('postal_code')->nullable(); // Kode Pos
            $table->boolean('has_existing_loans')->default(false); // Penghasilan/pinjaman (Ya/Tidak)
            $table->string('family_card_number')->nullable(); // No Kartu Keluarga

            // Data Pasangan (apabila memilih profil usaha perseorangan & status menikah)
            $table->boolean('has_spouse')->default(false);
            $table->string('spouse_name')->nullable();
            $table->string('spouse_phone')->nullable();
            $table->string('spouse_birth_place_date')->nullable();
            $table->string('spouse_id_card_number')->nullable();
            $table->string('spouse_npwp')->nullable();
            $table->text('spouse_address')->nullable();
            $table->string('spouse_city')->nullable();
            $table->string('spouse_province')->nullable();
            $table->string('spouse_postal_code')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->decimal('spouse_monthly_income', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
