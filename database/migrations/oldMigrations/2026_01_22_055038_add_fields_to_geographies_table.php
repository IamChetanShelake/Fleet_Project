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
        Schema::table('geographies', function (Blueprint $table) {
            if (!Schema::hasColumn('geographies', 'code')) {
                $table->string('code')->unique()->after('name');
            }
            if (!Schema::hasColumn('geographies', 'currency')) {
                $table->string('currency')->nullable()->after('code');
            }
            if (!Schema::hasColumn('geographies', 'region')) {
                $table->string('region')->nullable()->after('currency');
            }
            if (!Schema::hasColumn('geographies', 'description')) {
                $table->text('description')->nullable()->after('region');
            }
            if (!Schema::hasColumn('geographies', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('status');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('geographies', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('geographies', function (Blueprint $table) {
            //
        });
    }
};
