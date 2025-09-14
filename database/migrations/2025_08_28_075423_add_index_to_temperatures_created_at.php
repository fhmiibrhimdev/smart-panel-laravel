<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('temperatures', function (Blueprint $table) {
            $table->index('created_at'); // ✅ tambahkan index
        });
    }

    public function down(): void
    {
        Schema::table('temperatures', function (Blueprint $table) {
            $table->dropIndex(['created_at']); // rollback index
        });
    }
};
