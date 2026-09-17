<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CreditScoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_id',
        'certificate_id',
        'credit_score',
        'rating_grade',
        'rating_description',
        'score_5c_character',
        'score_5c_capacity',
        'score_5c_collateral',
        'score_5c_capital',
        'score_5c_condition',
        'score_5c_total',
        'score_4p_personality',
        'score_4p_prospek',
        'score_4p_produktivitas',
        'score_4p_payment',
        'score_4p_total',
        'big5_openness',
        'big5_conscientiousness',
        'big5_extraversion',
        'big5_agreeableness',
        'big5_neuroticism',
        'big5_summary',
        'slik_status',
        'slik_score',
        'summary_notes',
        'is_active',
        'scoring_date',
    ];

    protected function casts(): array
    {
        return [
            'credit_score' => 'integer',
            'score_5c_character' => 'decimal:2',
            'score_5c_capacity' => 'decimal:2',
            'score_5c_collateral' => 'decimal:2',
            'score_5c_capital' => 'decimal:2',
            'score_5c_condition' => 'decimal:2',
            'score_5c_total' => 'decimal:2',
            'score_4p_personality' => 'decimal:2',
            'score_4p_prospek' => 'decimal:2',
            'score_4p_produktivitas' => 'decimal:2',
            'score_4p_payment' => 'decimal:2',
            'score_4p_total' => 'decimal:2',
            'big5_openness' => 'decimal:2',
            'big5_conscientiousness' => 'decimal:2',
            'big5_extraversion' => 'decimal:2',
            'big5_agreeableness' => 'decimal:2',
            'big5_neuroticism' => 'decimal:2',
            'is_active' => 'boolean',
            'scoring_date' => 'datetime',
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

    public function loanApplications(): HasMany
    {
        return $this->hasMany(LoanApplication::class);
    }
}
