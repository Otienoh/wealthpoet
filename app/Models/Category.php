<?php

namespace App\Models;

use App\Models\Pivots\BudgetItemCategory;
use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use OwnedByUser;
    use HasRecursiveRelationships;

    public const TYPE_INCOME = 1;

    public const TYPE_EXPENSE = 2;

    public const TYPE_TRANSFER = 3;

    protected $fillable = ['user_id', 'parent_id', 'name', 'color', 'type', 'is_hidden', 'icon',];

    /**
     * The model retrieved is of Income type
     *
     * @return bool
     */
    public function isIncome(): bool
    {
        return $this->type == self::TYPE_INCOME;
    }

    /**
     * The model retrieved is of Expense type
     *
     * @return bool
     */
    public function isExpense(): bool
    {
        return $this->type == self::TYPE_EXPENSE;
    }

    /**
     * The model retrieved is of Expense type
     *
     * @return bool
     */
    public function isTransfer(): bool
    {
        return $this->type == self::TYPE_TRANSFER;
    }

    /**
     * Retrieves the category based on the specified type
     *
     * @param Builder $builder
     * @param $type
     */
    public function scopeOfType(Builder $builder, $type): void
    {
        $builder->where('type', $type);
    }

    /**
     * @return BelongsToMany
     */
    public function budgetItems(): BelongsToMany
    {
        return $this->belongsToMany(BudgetItem::class)->withTimestamps()
            ->using(BudgetItemCategory::class);
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return HasMany
     */
    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    /**
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * @return HasMany
     */
    public function transfers(): HasMany
    {
        return $this->hasMany(Transfer::class);
    }
}
