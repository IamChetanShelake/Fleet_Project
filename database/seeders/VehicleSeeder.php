<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\DrivingTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing brands and drivers
        $brands = Brand::where('is_active', true)->get();
        $drivers = DrivingTeam::where('status', 'active')->get();

        if ($brands->isEmpty()) {
            // Create some sample brands if none exist
            $sampleBrands = [
                ['name' => 'Toyota', 'slug' => 'toyota', 'is_active' => true],
                ['name' => 'Honda', 'slug' => 'honda', 'is_active' => true],
                ['name' => 'Tata', 'slug' => 'tata', 'is_active' => true],
            ];

            foreach ($sampleBrands as $brand) {
                Brand::create($brand);
            }
            $brands = Brand::where('is_active', true)->get();
        }

        $vehicles = [
            [
                'brand' => $brands->first()->name ?? 'Toyota',
                'model' => 'Innova Crysta',
                'vehicle_number' => 'MH01AB1234',
                'purchase_date' => '2022-06-15',
                'registration_year' => 2022,
                'color' => 'White',
                'fuel_type' => 'Diesel',
                'average' => '14 km/l',
                'max_weight' => '2000 kg',
                'current_odometer' => '45000',
                'insurance_valid_till' => '2025-06-15',
                'puc_expiry' => '2025-06-15',
                'vehicle_type' => 'SUV',
                'status' => 'available',
                'driver_id' => $drivers->isNotEmpty() ? $drivers->first()->id : null,
            ],
            [
                'brand' => $brands->skip(1)->first()->name ?? 'Honda',
                'model' => 'City',
                'vehicle_number' => 'MH02CD5678',
                'purchase_date' => '2023-03-20',
                'registration_year' => 2023,
                'color' => 'Silver',
                'fuel_type' => 'Petrol',
                'average' => '18 km/l',
                'max_weight' => '1500 kg',
                'current_odometer' => '25000',
                'insurance_valid_till' => '2026-03-20',
                'puc_expiry' => '2026-03-20',
                'vehicle_type' => 'Sedan',
                'status' => 'available',
                'driver_id' => $drivers->count() > 1 ? $drivers->skip(1)->first()->id : null,
            ],
            [
                'brand' => $brands->skip(2)->first()->name ?? 'Tata',
                'model' => 'Ace',
                'vehicle_number' => 'MH03EF9012',
                'purchase_date' => '2021-11-10',
                'registration_year' => 2021,
                'color' => 'Blue',
                'fuel_type' => 'Diesel',
                'average' => '22 km/l',
                'max_weight' => '850 kg',
                'current_odometer' => '75000',
                'insurance_valid_till' => '2024-11-10',
                'puc_expiry' => '2024-11-10',
                'vehicle_type' => 'Mini Truck',
                'status' => 'available',
                'driver_id' => $drivers->count() > 2 ? $drivers->skip(2)->first()->id : null,
            ],
            [
                'brand' => $brands->first()->name ?? 'Toyota',
                'model' => 'Fortuner',
                'vehicle_number' => 'MH04GH3456',
                'purchase_date' => '2023-08-05',
                'registration_year' => 2023,
                'color' => 'Black',
                'fuel_type' => 'Diesel',
                'average' => '12 km/l',
                'max_weight' => '2200 kg',
                'current_odometer' => '18000',
                'insurance_valid_till' => '2026-08-05',
                'puc_expiry' => '2026-08-05',
                'vehicle_type' => 'SUV',
                'status' => 'not_available',
                'driver_id' => $drivers->count() > 3 ? $drivers->skip(3)->first()->id : null,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}