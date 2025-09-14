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
        Schema::create('currents', function (Blueprint $table) {
            $table->id();
            $table->text('timestamps')->nullable();
            $table->text('curr_a')->nullable();
            $table->text('curr_bc')->nullable();
            $table->text('curr_bh')->nullable();
            $table->text('curr_c')->nullable();
            $table->text('curr_dh')->nullable();
            $table->text('curr_dc')->nullable();
            $table->text('curr_fc')->nullable();
            $table->text('curr_fh')->nullable();
            $table->text('curr_g')->nullable();
            $table->text('curr_hh')->nullable();
            $table->text('curr_hc')->nullable();
            $table->text('curr_i')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currents');
    }
};
