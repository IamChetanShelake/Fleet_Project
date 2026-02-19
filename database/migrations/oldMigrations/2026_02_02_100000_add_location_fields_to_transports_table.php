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
        Schema::table('transports', function (Blueprint $table) {
            // Source party additional fields
            $table->string('source_building_no')->nullable();
            $table->string('source_maps_link')->nullable();

            // Destination additional fields
            $table->string('dest_building_no')->nullable();
            $table->string('dest_maps_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn([
                'source_building_no', 'source_maps_link',
                'dest_building_no', 'dest_maps_link'
            ]);
        });
    }
};
