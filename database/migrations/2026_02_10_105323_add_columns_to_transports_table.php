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
            $table->decimal('pickupLatitude', 10, 7)->nullable()->after('delivery_location');
            $table->decimal('pickupLongitude', 10, 7)->nullable()->after('pickupLatitude');
            $table->decimal('deliveryLatitude', 10, 7)->nullable()->after('pickupLongitude');
            $table->decimal('deliveryLongitude', 10, 7)->nullable()->after('deliveryLatitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transports', function (Blueprint $table) {
            //
        });
    }
};
