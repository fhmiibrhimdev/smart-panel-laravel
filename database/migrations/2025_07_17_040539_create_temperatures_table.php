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
        Schema::create('temperatures', function (Blueprint $table) {
            $table->id();
            $table->text('recorded_at')->nullable();
            $table->text('temp_a')->nullable();
            $table->text('temp_bc')->nullable();
            $table->text('temp_bh')->nullable();
            $table->text('temp_c')->nullable();
            $table->text('temp_dh')->nullable();
            $table->text('temp_dc')->nullable();
            $table->text('temp_fc')->nullable();
            $table->text('temp_fh')->nullable();
            $table->text('temp_g')->nullable();
            $table->text('temp_hh')->nullable();
            $table->text('temp_hc')->nullable();
            $table->text('temp_i')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temperatures');
    }
};
