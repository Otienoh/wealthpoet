<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryGroup extends Model
{
    use HasFactory;
    use OwnedByUser;

    public const TYPE_INCOME = 1;

    public const TYPE_EXPENSE = 2;

    public const TYPE_TRANSFER = 3;

    protected $fillable = ['user_id', 'name', 'color', 'type', 'is_hidden'];

    /**
     * The model retrieved is of Income type
     *
     * @return boolean
     */
    public function isIncome(): bool
    {
        return $this->type == self::TYPE_INCOME;
    }

    /**
     * The model retrieved is of Expense type
     *
     * @return boolean
     */
    public function isExpense(): bool
    {
        return $this->type == self::TYPE_EXPENSE;
    }

    /**
     * The model retrieved is of Expense type
     *
     * @return boolean
     */
    public function isTransfer(): bool
    {
        return $this->type == self::TYPE_TRANSFER;
    }

    /**
     * Retrieves the category group based on the specified type
     *
     * @param Builder $builder
     * @param $type
     */
    public function scopeOfType(Builder $builder, $type): void
    {
        $builder->where('type', $type);
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
