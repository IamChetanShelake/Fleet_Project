<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->decimal('total_distance', 10, 2)->nullable()->after('total_cost');
            $table->string('total_travel_time')->nullable()->after('total_distance');
        });
    }

    public function down()
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn(['total_distance', 'total_travel_time']);
        });
    }
};
