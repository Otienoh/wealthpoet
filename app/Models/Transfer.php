<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Transfer extends Model
{
    use HasFactory;
    use OwnedByUser;

    protected $fillable = [
        'user_id',
        'account_id',
        'destination_account_id',
        'category_id',
        'description',
        'amount',
        'date',
        'notes',
        'recurs',
        'next_recurrence_date',
        'location',
        'extra_data',
    ];

    protected $casts = [
        'date' => 'date',
        'next_recurrence_date' => 'datetime',
        'extra_data' => 'array',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->category_id = Category::first()->id;
            $model->description ??= "Transfer {$model->amount} from {$model->account->name} to {$model->destinationAccount->name}";
        });

        static::created(function ($model) {
            Transaction::logTransfer($model);
        });
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return BelongsTo
     */
    public function destinationAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'destination_account_id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return MorphMany
     */
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
