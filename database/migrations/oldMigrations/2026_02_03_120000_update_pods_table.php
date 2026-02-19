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
        Schema::table('pods', function (Blueprint $table) {
            $table->dropColumn(['file_type', 'file_size', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pods', function (Blueprint $table) {
            $table->string('file_type')->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->text('description')->nullable();
        });
    }
};
