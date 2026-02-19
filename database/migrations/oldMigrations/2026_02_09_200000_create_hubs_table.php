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
        Schema::create('hubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('code')->unique();
            $table->text('address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('geographies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hubs');
    }
};
