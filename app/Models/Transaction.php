<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
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
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($model) {
            Account::settleAccount($model);
        });
    }

    public static function logIncome(Income $income): self
    {
        return self::create([
            'user_id' => $income->user_id,
            'account_id' => $income->account_id,
            'category_id' => $income->category_id,
            'amount' => $income->amount,
            'description' => $income->description,
            'transaction_date' => $income->date,
            'transaction_reference' => "Income Id {$income->id}",
            'credit' => $income->amount,
            'transactionable_id' => $income->id,
            'transactionable_type' => Income::class,
        ]);
    }

    public static function logExpense(Expense $expense): self
    {
        return self::create([
            'user_id' => $expense->user_id,
            'account_id' => $expense->account_id,
            'category_id' => $expense->category_id,
            'amount' => $expense->amount,
            'description' => $expense->description,
            'transaction_date' => $expense->date,
            'transaction_reference' => "Expense Id {$expense->id}",
            'debit' => $expense->amount,
            'transactionable_id' => $expense->id,
            'transactionable_type' => Expense::class,
        ]);
    }

    public static function logTransfer(Transfer $transfer): self
    {
        self::create([
            'user_id' => $transfer->user_id,
            'account_id' => $transfer->account_id,
            'category_id' => $transfer->category_id,
            'amount' => $transfer->amount,
            'description' => $transfer->description,
            'transaction_date' => $transfer->date,
            'transaction_reference' => "Transfer {$transfer->id}",
            'debit' => $transfer->amount,
            'transactionable_id' => $transfer->id,
            'transactionable_type' => Transfer::class,
        ]);

        return self::create([
            'user_id' => $transfer->user_id,
            'account_id' => $transfer->destination_account_id,
            'category_id' => $transfer->category_id,
            'amount' => $transfer->amount,
            'description' => $transfer->description,
            'transaction_date' => $transfer->date,
            'transaction_reference' => "Transfer {$transfer->id}",
            'credit' => $transfer->amount,
            'transactionable_id' => $transfer->id,
            'transactionable_type' => Transfer::class,
        ]);
    }

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
