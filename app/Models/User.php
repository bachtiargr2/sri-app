<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi Profil Calon Debitur (1-to-1)
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Relasi Profil Usaha (1-to-1)
     */
    public function business(): HasOne
    {
        return $this->hasOne(Business::class);
    }

    /**
     * Relasi Laporan Keuangan 3 Periode (1-to-Many)
     */
    public function financialReports(): HasMany
    {
        return $this->hasMany(FinancialReport::class)->orderBy('period_order');
    }

    /**
     * Relasi Data Agunan / Collateral (1-to-Many)
     */
    public function collaterals(): HasMany
    {
        return $this->hasMany(Collateral::class);
    }

    /**
     * Relasi Jawaban Kuesioner Asesmen Manajemen, Prospek, dan Big-Five (1-to-Many)
     */
    public function questionnaires(): HasMany
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * Relasi Hasil Pemeringkatan & Sertifikat Rating Aktif (1-to-1)
     */
    public function creditScoring(): HasOne
    {
        return $this->hasOne(CreditScoring::class)->where('is_active', true)->latestOfMany();
    }

    /**
     * Riwayat Seluruh Pemeringkatan (1-to-Many)
     */
    public function creditScorings(): HasMany
    {
        return $this->hasMany(CreditScoring::class)->latest();
    }

    /**
     * Relasi Seluruh Pengajuan Pembiayaan & Penjaminan (1-to-Many)
     */
    public function loanApplications(): HasMany
    {
        return $this->hasMany(LoanApplication::class)->latest();
    }
}

