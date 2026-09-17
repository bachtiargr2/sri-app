<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'code',
        'logo_path',
        'description',
        'interest_rate_min',
        'interest_rate_max',
        'max_tenor_months',
        'max_plafon',
        'supported_tracks',
        'contact_email',
        'contact_phone',
        'website',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'interest_rate_min' => 'decimal:2',
            'interest_rate_max' => 'decimal:2',
            'max_plafon' => 'decimal:2',
            'max_tenor_months' => 'integer',
            'supported_tracks' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function loanApplications(): HasMany
    {
        return $this->hasMany(LoanApplication::class);
    }
}
