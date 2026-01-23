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
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign(['geography_id']);
            $table->renameColumn('geography_id', 'country_id');

            $table->unsignedBigInteger('hub_id')->nullable()->after('country_id');
            $table->string('postal_code')->nullable()->after('hub_id');
            $table->decimal('latitude', 10, 8)->nullable()->after('postal_code');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('timezone')->nullable()->after('longitude');

            $table->foreign('country_id')->references('id')->on('geographies')->onDelete('cascade');
            $table->foreign('hub_id')->references('id')->on('hubs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            //
        });
    }
};
