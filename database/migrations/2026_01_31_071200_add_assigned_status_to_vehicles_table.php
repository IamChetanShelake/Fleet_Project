<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the enum to include 'assigned' status
        Schema::table('vehicles', function (Blueprint $table) {
            // Drop the existing enum and add new one with 'assigned'
            DB::statement("ALTER TABLE vehicles MODIFY COLUMN status ENUM('available', 'not_available', 'assigned') DEFAULT 'available'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum
        Schema::table('vehicles', function (Blueprint $table) {
            DB::statement("ALTER TABLE vehicles MODIFY COLUMN status ENUM('available', 'not_available') DEFAULT 'available'");
        });
    }
};
