<?php

use App\Models\Budget;
use App\Models\BudgetItem;
use App\Models\Category;
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
        Schema::create('budget_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Budget::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->bigInteger('goal_amount')->default(0);
            $table->bigInteger('spent_amount')->default(0);
            $table->timestamps();
        });

        Schema::create('budget_item_category', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BudgetItem::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('budget_item_category');
        Schema::dropIfExists('budget_items');
    }
};
