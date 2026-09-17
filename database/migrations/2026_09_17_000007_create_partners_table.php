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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Bank BNI, Bank Mandiri, Bank BSI, Jamkrindo, Jamkrida Jakarta
            $table->enum('category', ['Bank', 'LK Non-Bank', 'Lembaga Penjaminan', 'Pendamping Usaha']);
            $table->string('code')->unique()->nullable(); // e.g. BNI, MANDIRI, BSI, JAMKRINDO
            $table->string('logo_path')->nullable();
            $table->text('description')->nullable();
            
            // Produk & Syarat Finansial
            $table->decimal('interest_rate_min', 5, 2)->nullable(); // e.g. 1.00 %
            $table->decimal('interest_rate_max', 5, 2)->nullable(); // e.g. 5.00 %
            $table->integer('max_tenor_months')->nullable(); // e.g. 60 bulan
            $table->decimal('max_plafon', 15, 2)->nullable(); // Plafon maksimal
            $table->json('supported_tracks')->nullable(); // ['kredit', 'cash_loan', 'non_cash_loan']
            
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
