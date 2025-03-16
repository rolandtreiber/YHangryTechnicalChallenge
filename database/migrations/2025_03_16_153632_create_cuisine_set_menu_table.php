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
        Schema::create('cuisine_set_menu', function (Blueprint $table) {
            $table->foreignId('cuisine_id')->constrained()->cascadeOnDelete();
            $table->foreignId('set_menu_id')->constrained()->cascadeOnDelete();

            $table->unique(['cuisine_id', 'set_menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuisine_set_menu');
    }
};
