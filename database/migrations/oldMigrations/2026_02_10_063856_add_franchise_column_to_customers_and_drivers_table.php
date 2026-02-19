<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //  Add nullable column FIRST (no FK yet)
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('franchise')
                  ->nullable()
                  ->after('billing_address');
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->foreignId('franchise')
                  ->nullable()
                  ->after('phone');
        });

        //  Add FK AFTER data is safe
        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('franchise')
                  ->references('id')
                  ->on('franchises')
                  ->nullOnDelete();
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->foreign('franchise')
                  ->references('id')
                  ->on('franchises')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['franchise']);
            $table->dropColumn('franchise');
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->dropForeign(['franchise']);
            $table->dropColumn('franchise');
        });
    }
};

