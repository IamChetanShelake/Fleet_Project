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
        // Check if the transports table has a status column and update it
        if (Schema::hasTable('transports')) {
            // Check current column type
            $columnType = DB::select("SHOW COLUMNS FROM transports WHERE Field = 'status'")[0]->Type ?? '';

            // If status is an enum, we need to modify it to include 'pending'
            if (str_contains($columnType, 'enum')) {
                // Modify enum to include all status values including 'pending'
                DB::statement("ALTER TABLE transports MODIFY COLUMN status ENUM('pending', 'draft', 'assigned', 'confirmed', 'in_transit', 'delivered', 'cancelled') DEFAULT 'pending'");
            } elseif (str_contains($columnType, 'varchar')) {
                // If it's a varchar, no change needed as it accepts any string
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum values without 'pending'
        if (Schema::hasTable('transports')) {
            $columnType = DB::select("SHOW COLUMNS FROM transports WHERE Field = 'status'")[0]->Type ?? '';

            if (str_contains($columnType, 'enum')) {
                DB::statement("ALTER TABLE transports MODIFY COLUMN status ENUM('draft', 'assigned', 'confirmed', 'in_transit', 'delivered', 'cancelled') DEFAULT 'draft'");
            }
        }
    }
};
