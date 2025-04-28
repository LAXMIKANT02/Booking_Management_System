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
        // Check if the 'status' column already exists to avoid adding it again
        if (!Schema::hasColumn('bookings', 'status')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->integer('status')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'status' column if it was added
        if (Schema::hasColumn('bookings', 'status')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
