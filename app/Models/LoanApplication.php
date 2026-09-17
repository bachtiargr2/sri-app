<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'user_id',
        'business_id',
        'partner_id',
        'credit_scoring_id',
        'submission_track',
        'loan_amount',
        'tenor_months',
        'estimated_interest_rate',
        'loan_purpose',
        'submission_region',
        'institution_types',
        'selected_product_type',
        'selected_product_name',
        'status',
        'qualification',
        'subqualification_code',
        'cert_issuer',
        'cert_issued_date',
        'cert_valid_date',
        'project_name',
        'employer_name',
        'project_type',
        'contract_value',
        'spk_pks_number',
        'non_cash_guarantee_type',
        'payment_terms',
        'project_location',
        'funding_source',
        'funder_name',
        'doc_spk_contract_path',
        'doc_proposal_photo_path',
        'doc_past_project_record_path',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'loan_amount' => 'decimal:2',
            'contract_value' => 'decimal:2',
            'tenor_months' => 'integer',
            'institution_types' => 'array',
            'cert_issued_date' => 'date',
            'cert_valid_date' => 'date',
            'submitted_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function creditScoring(): BelongsTo
    {
        return $this->belongsTo(CreditScoring::class);
    }
}
