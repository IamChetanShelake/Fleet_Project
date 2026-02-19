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
        Schema::table('vehicles', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['driver_id']);

            // Add new foreign key constraint to driving_teams table
            $table->foreign('driver_id')->references('id')->on('driving_teams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Drop the foreign key constraint to driving_teams
            $table->dropForeign(['driver_id']);

            // Add back the original foreign key constraint to drivers table
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('set null');
        });
    }
};
