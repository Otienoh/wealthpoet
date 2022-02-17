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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
                    $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); //owner
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete(); // grouping
            $table->foreignIdFor(Account::class)->constrained()->cascadeOnDelete(); //account_origin
            $table->foreignIdFor(Account::class, 'destination_account_id'); //account_destination
            $table->text('description');
            $table->bigInteger('amount');
            $table->date('date');
            $table->text('notes')->nullable();
            $table->string('recurs')->nullable();
            $table->timestamp('next_recurrence_date')->nullable();
            $table->text('location')->nullable();
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
        Schema::dropIfExists('transfers');
    }
};
