<?php

use App\Models\Account;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); //owner
            $table->foreignIdFor(Account::class)->constrained()->cascadeOnDelete(); //account_origin
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete(); // grouping
            $table->text('description');
            $table->bigInteger('amount');
            $table->date('transaction_date');
            $table->string('transaction_reference');
            $table->morphs('transactionable');
            $table->bigInteger('debit')->default(0);
            $table->bigInteger('credit')->default(0);
            $table->boolean('hidden')->default(false);
            $table->json('extra_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
