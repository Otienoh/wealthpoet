<?php

use App\Models\Account;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); //owner
            $table->foreignIdFor(Account::class)->constrained()->cascadeOnDelete(); //account_origin
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete(); // grouping
            $table->text('description'); // name/details
            $table->bigInteger('amount'); //amount
            $table->date('date'); //date occurring
            $table->text('notes')->nullable(); //extra notes on transactions
            $table->string('recurs')->nullable(); // checks if it recurs daily, weekly or null
            $table->timestamp('next_recurrence_date')->nullable(); //date it will recurr
            $table->text('location')->nullable(); // loction data
            $table->json('extra_data')->nullable(); // capture extra data
            $table->boolean('is_income')->default(true); // identify transaction as income
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
        Schema::dropIfExists('incomes');
    }
};
