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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('email');
            $table->enum('role', [
                'Super Admin',
                'Admin',
                'Supervisor',
                'Account Staff',
                'Country Finance Aid',
                'Franchise Manager',
                'Co-Ordinator'
            ])->default('Admin')->after('mobile');
            $table->string('department')->nullable()->after('role');
            $table->string('position')->nullable()->after('department');
            $table->date('date_of_joining')->nullable()->after('position');
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->after('date_of_joining');
            $table->string('profile_image')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mobile',
                'role',
                'department',
                'position',
                'date_of_joining',
                'status',
                'profile_image'
            ]);
        });
    }
};
