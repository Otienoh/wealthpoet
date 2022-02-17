<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;
    use OwnedByUser;

    protected $fillable = [
        'user_id',
        'account_id',
        'category_id',
        'amount',
        'description',
        'transaction_date',
        'transaction_reference',
        'extra_data',
        'hidden',
        'debit',
        'credit',
        'transactionable_id',
        'transactionable_type',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'hidden' => 'boolean',
        'extra_data' => 'array',
    ];

    /**
     * @return MorphTo
     */
    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
