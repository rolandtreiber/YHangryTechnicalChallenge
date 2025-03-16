<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('set_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('display_text');
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_vegan');
            $table->boolean('is_vegetarian');
            $table->tinyInteger('status');
            $table->double('price_per_person');
            $table->double('min_spend');
            $table->boolean('is_seated');
            $table->boolean('is_standing');
            $table->boolean('is_canape');
            $table->boolean('is_mixed_dietary');
            $table->boolean('is_meal_prep');
            $table->boolean('is_halal');
            $table->boolean('is_kosher');
            $table->boolean('available');
            $table->unsignedBigInteger('number_of_orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_menus');
    }
};
