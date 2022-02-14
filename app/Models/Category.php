<?php

namespace App\Models;

use App\Models\Pivots\BudgetItemCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_group_id', 'name', 'icon'];

    /**
     * @return BelongsTo
     */
    public function categoryGroup(): BelongsTo
    {
        return $this->belongsTo(CategoryGroup::class);
    }

    /**
     * @return BelongsToMany
     */
    public function budgetItems(): BelongsToMany
    {
        return $this->belongsToMany(BudgetItem::class)->withTimestamps()
            ->using(BudgetItemCategory::class);
    }
}
