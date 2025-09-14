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
        Schema::create('powers', function (Blueprint $table) {
            $table->id();
            $table->text('timestamps')->nullable();
            $table->text('voltage_1')->nullable();
            $table->text('voltage_2')->nullable();
            $table->text('voltage_3')->nullable();
            $table->text('voltage_4')->nullable();
            $table->text('voltage_5')->nullable();
            $table->text('current_1')->nullable();
            $table->text('current_2')->nullable();
            $table->text('current_3')->nullable();
            $table->text('current_4')->nullable();
            $table->text('current_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('powers');
    }
};
