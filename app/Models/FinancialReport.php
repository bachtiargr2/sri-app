<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_id',
        'period_year',
        'period_order',
        'operating_revenue',
        'other_operating_revenue',
        'total_operating_revenue',
        'operational_expense',
        'labor_expense',
        'training_expense',
        'rent_expense',
        'promotion_expense',
        'tax_expense',
        'maintenance_expense',
        'depreciation_expense',
        'admin_general_expense',
        'other_operating_expense',
        'net_operating_income',
        'non_operating_revenue',
        'non_operating_expense',
        'net_profit',
        'cash',
        'net_cash',
        'current_assets',
        'total_current_assets',
        'acquisition_cost',
        'accumulated_depreciation',
        'total_fixed_assets',
        'other_assets',
        'total_assets',
        'short_term_liabilities',
        'other_liabilities',
        'total_liabilities',
        'share_capital',
        'paid_in_capital',
        'retained_earnings',
        'current_year_earnings',
        'total_equity',
        'total_liabilities_and_equity',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'period_order' => 'integer',
            'operating_revenue' => 'decimal:2',
            'other_operating_revenue' => 'decimal:2',
            'total_operating_revenue' => 'decimal:2',
            'operational_expense' => 'decimal:2',
            'labor_expense' => 'decimal:2',
            'training_expense' => 'decimal:2',
            'rent_expense' => 'decimal:2',
            'promotion_expense' => 'decimal:2',
            'tax_expense' => 'decimal:2',
            'maintenance_expense' => 'decimal:2',
            'depreciation_expense' => 'decimal:2',
            'admin_general_expense' => 'decimal:2',
            'other_operating_expense' => 'decimal:2',
            'net_operating_income' => 'decimal:2',
            'non_operating_revenue' => 'decimal:2',
            'non_operating_expense' => 'decimal:2',
            'net_profit' => 'decimal:2',
            'cash' => 'decimal:2',
            'net_cash' => 'decimal:2',
            'current_assets' => 'decimal:2',
            'total_current_assets' => 'decimal:2',
            'acquisition_cost' => 'decimal:2',
            'accumulated_depreciation' => 'decimal:2',
            'total_fixed_assets' => 'decimal:2',
            'other_assets' => 'decimal:2',
            'total_assets' => 'decimal:2',
            'short_term_liabilities' => 'decimal:2',
            'other_liabilities' => 'decimal:2',
            'total_liabilities' => 'decimal:2',
            'share_capital' => 'decimal:2',
            'paid_in_capital' => 'decimal:2',
            'retained_earnings' => 'decimal:2',
            'current_year_earnings' => 'decimal:2',
            'total_equity' => 'decimal:2',
            'total_liabilities_and_equity' => 'decimal:2',
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
}
