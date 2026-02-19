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
            $table->bigInteger('cargoType')->constrained('cargo_types')->nullable()->after('receiver_mobile')->nullable();
            $table->boolean('fragile')->default(false)->after('cargoType');
            $table->boolean('perishable')->default(false)->after('fragile');
            $table->decimal('width',8,2)->nullable()->after('perishable');
            $table->decimal('height',8,2)->nullable()->after('width');
            $table->decimal('length',8,2)->nullable()->after('height');
            $table->longText('Instructions')->nullable()->after('length');
            $table->string('invoice')->nullable()->after('Instructions');
            $table->string('packageSlip')->nullable()->after('invoice');
            $table->string('deliveryChallan')->nullable()->after('packageSlip');
            $table->string('CargoDocs')->nullable()->after('deliveryChallan');
            $table->string('remarks')->nullable()->after('CargoDocs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn([
                'cargoType',
                'fragile',
                'perishable',
                'width',
                'height',
                'length',
                'Instructions',
                'invoice',
                'packageSlip',
                'deliveryChallan',
                'CargoDocs',
                'remarks'
            ]);
        });
    }
};
