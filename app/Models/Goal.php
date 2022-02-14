<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Goal extends Model
{
    use HasFactory;
    use OwnedByUser;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'color',
        'icon',
        'initial_value',
        'target_value',
        'target_date',
        'completed_at',
    ];

    protected $casts = [
        'target_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function goalDeposits(): HasMany
    {
        return $this->hasMany(GoalDeposit::class);
    }
}
