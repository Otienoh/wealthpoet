<?php

namespace App\Models;

use App\Models\Pivots\BudgetItemCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BudgetItem extends Model
{
    use HasFactory;

    public const STATUS_BALANCED = 1;

    public const STATUS_UNDERSPEND = 2;

    public const STATUS_OVERSPEND = 3;

    protected $fillable = [
        'budget_id',
        'name',
        'goal_amount',
        'spent_amount',
    ];

    /**
     * Calculate the remaining amount
     *
     * @return int
     */
    public function balance(): int
    {
        return $this->goal_amount - $this->spent_amount;
    }

    public function status()
    {
        $balance = $this->balance();

        return match (true) {
            $balance > 0 => BudgetItem::STATUS_UNDERSPEND,
            $balance == 0 => BudgetItem::STATUS_BALANCED,
            $balance < 0 => BudgetItem::STATUS_OVERSPEND,
        };
    }

    /**
     * @return BelongsTo
     */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    /**
     * @return BelongsToMany
     */
    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps()
            ->using(BudgetItemCategory::class);
    }
}
