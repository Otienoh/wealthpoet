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

    public const STATUS_BALANCED = 1;

    public const STATUS_UNDERSPEND = 2;

    public const STATUS_OVERSPEND = 3;

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
     * @return bool
     */
    public function isAMonthlyBudget(): bool
    {
        return $this->type == self::TYPE_MONTHLY;
    }

    /**
     * The model retrieved is a Custom Budget
     *
     * @return bool
     */
    public function isACustomBudget(): bool
    {
        return $this->type == (self::TYPE_CUSTOM);
    }

    /**
     * Retrieves only Custom Budgets
     *
     * @param Builder $builder
     */
    public function scopeCustomBudget(Builder $builder): void
    {
        $builder->where('type', self::TYPE_CUSTOM);
    }

    /**
     * Retrieves only Monthly Budgets
     *
     * @param Builder $builder
     */
    public function scopeMonthlyBudget(Builder $builder): void
    {
        $builder->where('type', self::TYPE_MONTHLY);
    }

    /**
     * Calculate the remaining amount
     *
     * @return int
     */
    public function totalSpending(): int
    {
        return $this->budgetItems()->sum('spent_amount');
    }

    public function status()
    {
        $balance = $this->income_spending_goal - $this->totalSpending();

        return match (true) {
            $balance > 0 => self::STATUS_UNDERSPEND,
            $balance == 0 => self::STATUS_BALANCED,
            $balance < 0 => self::STATUS_OVERSPEND,
        };
    }

    /**
     * @return HasMany
     */
    public function budgetItems(): HasMany
    {
        return $this->hasMany(BudgetItem::class);
    }
}
