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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id')->unique(); // e.g. TRX1230001
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('business_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('partner_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('credit_scoring_id')->nullable()->constrained()->nullOnDelete();
            
            // Track Pengajuan (Bab 4)
            $table->enum('submission_track', ['kredit', 'penjaminan_cash_loan', 'penjaminan_non_cash_loan']);
            $table->decimal('loan_amount', 15, 2); // Nilai Pengajuan
            $table->integer('tenor_months'); // Tenor (Bulan)
            $table->string('estimated_interest_rate')->nullable(); // e.g. "1% - 5% per bulan"
            $table->text('loan_purpose')->nullable(); // Deskripsi Penggunaan Pinjaman (Modal kerja, Investasi, dll)
            $table->string('submission_region')->nullable(); // Daerah Pengajuan / Domisili
            $table->json('institution_types')->nullable(); // Pilihan Jenis Lembaga ['Bank', 'LK Non-Bank', 'Lembaga Penjaminan']
            $table->string('selected_product_type')->nullable(); // Program (KUR) / Non-Program
            $table->string('selected_product_name')->nullable(); // e.g. "BNI untuk UMKM", "Kredit KUR"

            // Status Pengajuan (Draft -> Submitted -> In Review -> Approved / Rejected)
            $table->enum('status', ['draft', 'submitted', 'in_review', 'approved', 'rejected'])->default('submitted');

            // Atribut Khusus Penjaminan Non-Cash Loan (Bab 4.3)
            $table->string('qualification')->nullable(); // Kualifikasi Perusahaan Konstruksi (Besar/Kecil)
            $table->string('subqualification_code')->nullable(); // Kode Subkualifikasi (e.g. BG001)
            $table->string('cert_issuer')->nullable(); // Pelaksana Sertifikasi (e.g. Gapeksi)
            $table->date('cert_issued_date')->nullable(); // Tanggal Ditetapkan
            $table->date('cert_valid_date')->nullable(); // Tanggal Masa Berlaku
            $table->string('project_name')->nullable(); // Nama Pekerjaan / Proyek (e.g. Proyek Superblok Cikarang)
            $table->string('employer_name')->nullable(); // Nama Pemberi Pekerjaan (Pemerintah/Perusahaan)
            $table->string('project_type')->nullable(); // Jenis Pekerjaan
            $table->decimal('contract_value', 15, 2)->nullable(); // Nilai Pekerjaan / Kontrak
            $table->string('spk_pks_number')->nullable(); // Nomor Surat SPK / PKS Pekerjaan
            $table->string('non_cash_guarantee_type')->nullable(); // Jaminan Pelaksanaan, Jaminan Pemeliharaan, Resi Gudang, Bid Bond, dll
            $table->string('payment_terms')->nullable(); // Termin Pembayaran (e.g. 24 Bulan)
            $table->string('project_location')->nullable(); // Lokasi Pekerjaan atau Proyek
            $table->string('funding_source')->nullable(); // Sumber Pendanaan (e.g. Bank BNI)
            $table->string('funder_name')->nullable(); // Nama Pemilik Rekening Pendana
            
            // Upload Dokumen Pendukung Non-Cash Loan
            $table->string('doc_spk_contract_path')->nullable(); // Upload Surat Pekerjaan / Kontrak / SPK
            $table->string('doc_proposal_photo_path')->nullable(); // Upload Proposal / Foto Pekerjaan
            $table->string('doc_past_project_record_path')->nullable(); // Upload Riwayat Pekerjaan 3 Tahun Terakhir

            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
