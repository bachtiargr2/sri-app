<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'position',
        'email',
        'phone_number',
        'existing_scoring_value',
        'scoring_certificate_path',
        'id_card_number',
        'birth_place_date',
        'npwp',
        'address',
        'city',
        'province',
        'postal_code',
        'has_existing_loans',
        'family_card_number',
        'has_spouse',
        'spouse_name',
        'spouse_phone',
        'spouse_birth_place_date',
        'spouse_id_card_number',
        'spouse_npwp',
        'spouse_address',
        'spouse_city',
        'spouse_province',
        'spouse_postal_code',
        'spouse_occupation',
        'spouse_monthly_income',
    ];

    protected function casts(): array
    {
        return [
            'has_existing_loans' => 'boolean',
            'has_spouse' => 'boolean',
            'existing_scoring_value' => 'integer',
            'spouse_monthly_income' => 'decimal:2',
        ];
    }

    /**
     * User Pemilik Profil
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
