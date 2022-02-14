<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
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
     * @return HasMany
     */
    public function budgetItems(): HasMany
    {
        return $this->hasMany(BudgetItem::class);
    }
}
