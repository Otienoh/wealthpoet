<?php

namespace App\Models;

use App\Models\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    use OwnedByUser;

    protected $fillable = [
        'user_id',
        'institution_id',
        'account_type_id',
        'name',
        'color',
        'description',
        'initial_balance',
        'balance',
        'main',
        'include_in_net_worth',
        'include_in_dashboard_sum',
    ];

    protected $casts = [
        'main' => 'boolean',
        'include_in_net_worth' => 'boolean',
        'include_in_dashboard_sum' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->balance += $model->initial_balance;
        });
    }

    public static function settleAccount(Transaction $transaction)
    {
        $transaction->account()->increment('balance', (int) $transaction->credit);
        $transaction->account()->decrement('balance', (int) $transaction->debit);

    }

    /**
     * @return BelongsTo
     */
    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }

    /**
     * @return BelongsTo
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
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
