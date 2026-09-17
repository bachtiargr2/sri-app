<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'question_code',
        'question_text',
        'score_value',
        'selected_option',
        'additional_notes',
    ];

    protected function casts(): array
    {
        return [
            'score_value' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
