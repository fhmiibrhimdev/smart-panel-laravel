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
        Schema::create('voltages', function (Blueprint $table) {
            $table->id();
            $table->text('timestamps')->nullable();
            $table->text('volt_a')->nullable();
            $table->text('volt_bc')->nullable();
            $table->text('volt_bh')->nullable();
            $table->text('volt_c')->nullable();
            $table->text('volt_dh')->nullable();
            $table->text('volt_dc')->nullable();
            $table->text('volt_fc')->nullable();
            $table->text('volt_fh')->nullable();
            $table->text('volt_g')->nullable();
            $table->text('volt_hh')->nullable();
            $table->text('volt_hc')->nullable();
            $table->text('volt_i')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voltages');
    }
};
