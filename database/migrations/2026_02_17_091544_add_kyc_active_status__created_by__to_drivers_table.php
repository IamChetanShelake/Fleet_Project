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
        Schema::table('drivers', function (Blueprint $table) {
            $table->enum('activeStatus',['active','inactive'])->default('active')->after('status');
            $table->enum('kyc_status',['pending','under_review','approved','rejected'])->default('pending')->after('activeStatus');
            $table->enum('createdBy',['admin','self'])->default('admin')->after('kyc_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            //
        });
    }
};
