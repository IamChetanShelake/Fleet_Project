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
            // Source party details
            $table->string('consigner')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('source_pincode')->nullable();
            $table->string('source_city')->nullable();
            $table->string('source_state')->nullable();
            $table->string('source_country')->nullable();

            // Destination details
            $table->string('delivery_location')->nullable();
            $table->text('address_line')->nullable();
            $table->string('building_no')->nullable();
            $table->string('dest_pincode')->nullable();
            $table->string('dest_state')->nullable();
            $table->string('dest_country')->nullable();

            // Timeline
            $table->datetime('pickup_datetime')->nullable();
            $table->date('delivery_date')->nullable();

            // Receiver
            $table->string('receiver_name')->nullable();
            $table->string('receiver_mobile')->nullable();

            // Logistics info
            $table->string('party_lr_no')->nullable();
            $table->integer('packages')->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_value')->nullable();
            $table->enum('trip_type', ['FTL', 'LTL', 'Express'])->nullable();

            // Vehicle assignment
            $table->string('vehicle_type')->nullable();
            $table->string('assigned_vehicle_no')->nullable();
            $table->string('assigned_driver')->nullable();
            $table->string('assigned_driver_id')->nullable();
            $table->text('handling_instructions')->nullable();

            // Third party
            $table->string('third_party_name')->nullable();
            $table->string('third_party_vehicle')->nullable();

            // Freight costs
            $table->decimal('freight_weight', 10, 2)->nullable();
            $table->string('weight_unit')->nullable();
            $table->decimal('rate_per_unit', 10, 2)->nullable();
            $table->integer('total_packages')->nullable();
            $table->decimal('rate_per_package', 10, 2)->nullable();
            $table->decimal('fixed_cost', 10, 2)->nullable();

            // Expenses
            $table->json('expense_types')->nullable();
            $table->json('expense_amounts')->nullable();
            $table->json('expense_remarks')->nullable();

            // Final
            $table->text('final_notes')->nullable();
            $table->enum('status', ['draft', 'assigned', 'confirmed', 'completed'])->default('draft');
            $table->decimal('total_cost', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn([
                'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country',
                'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country',
                'pickup_datetime', 'delivery_date', 'receiver_name', 'receiver_mobile',
                'party_lr_no', 'packages', 'weight', 'invoice_no', 'invoice_value', 'trip_type',
                'vehicle_type', 'assigned_vehicle_no', 'assigned_driver', 'assigned_driver_id', 'handling_instructions',
                'third_party_name', 'third_party_vehicle',
                'freight_weight', 'weight_unit', 'rate_per_unit', 'total_packages', 'rate_per_package', 'fixed_cost',
                'expense_types', 'expense_amounts', 'expense_remarks',
                'final_notes', 'status', 'total_cost'
            ]);
        });
    }
};
