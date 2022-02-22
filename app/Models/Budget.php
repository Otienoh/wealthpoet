<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budget extends Model
{
    use HasFactory;
    use OwnedByUser;

    public const TYPE_MONTHLY = 1;

    public const TYPE_CUSTOM = 2;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
        'total_income',
        'income_spending_goal',
    ];

    /**
     * The model retrieved is a Monthly Budget
     *
     * @return boolean
     */
    public function isAMonthlyBudget(): bool
    {
        return $this->type == self::TYPE_MONTHLY;
    }

    /**
     * The model retrieved is a Custom Budget
     *
     * @return boolean
     */
    public function isACustomBudget(): bool
    {
        return $this->type == (self::TYPE_CUSTOM);
    }

    /**
     * Retrieves only Custom Budgets
     *
     * @param Builder $builder
     *
     */
    public function scopeCustomBudget(Builder $builder): void
    {
        $builder->where('type', self::TYPE_CUSTOM);
    }

    /**
     * Retrieves only Monthly Budgets
     *
     * @param Builder $builder
     *
     */
    public function scopeMonthlyBudget(Builder $builder): void
    {
        $builder->where('type', self::TYPE_MONTHLY);
    }

    /**
     * @return HasMany
     */
    public function budgetItems(): HasMany
    {
        return $this->hasMany(BudgetItem::class);
    }
}
