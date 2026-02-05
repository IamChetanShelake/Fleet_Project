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

            // If status is an enum, we need to modify it to include all values
            if (str_contains($columnType, 'enum')) {
                // Modify enum to include all status values
                DB::statement("ALTER TABLE transports MODIFY COLUMN status ENUM('draft', 'assigned', 'confirmed', 'in_transit', 'delivered', 'cancelled') DEFAULT 'draft'");
            } elseif (str_contains($columnType, 'varchar')) {
                // If it's a varchar, increase the length to 20
                DB::statement("ALTER TABLE transports MODIFY COLUMN status VARCHAR(20) DEFAULT 'draft'");
            } else {
                // For other types (like text), change to varchar with proper length
                DB::statement("ALTER TABLE transports MODIFY COLUMN status VARCHAR(20) DEFAULT 'draft'");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed as this is an update
    }
};
