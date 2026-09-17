<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_type',
        'business_name',
        'established_year',
        'legal_form',
        'business_address',
        'phone',
        'email',
        'website',
        'social_media',
        'deed_establishment_number',
        'deed_amendment_number',
        'npwp',
        'main_director',
        'other_directors',
        'main_commissioner',
        'other_commissioners',
        'employee_count',
        'business_classification',
        'revenue_range',
        'business_description',
        'product_permits',
        'has_giro_deficit',
        'doc_place_photo_path',
        'doc_product_photo_path',
        'doc_deed_nib_path',
    ];

    protected function casts(): array
    {
        return [
            'has_giro_deficit' => 'boolean',
            'employee_count' => 'integer',
        ];
    }

    /**
     * User Pemilik Usaha
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Laporan Keuangan 3 Periode Usaha
     */
    public function financialReports(): HasMany
    {
        return $this->hasMany(FinancialReport::class)->orderBy('period_order');
    }

    /**
     * Data Agunan yang Dimiliki Usaha
     */
    public function collaterals(): HasMany
    {
        return $this->hasMany(Collateral::class);
    }

    /**
     * Hasil Pemeringkatan Kredit Usaha
     */
    public function creditScorings(): HasMany
    {
        return $this->hasMany(CreditScoring::class);
    }

    /**
     * Pengajuan Pembiayaan Usaha
     */
    public function loanApplications(): HasMany
    {
        return $this->hasMany(LoanApplication::class);
    }
}
