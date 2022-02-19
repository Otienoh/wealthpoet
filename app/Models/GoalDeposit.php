<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalDeposit extends Model
{
    use HasFactory;

    protected $fillable = ['goal_id', 'deposited_at', 'amount'];

    protected $casts = [
        'deposited_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }
}
