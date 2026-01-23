<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'driver_id' => 'DRV001',
                'name' => 'Rajesh Kumar',
                'blood_group' => 'O+',
                'phone' => '+91 9876543210',
                'emergency_phone' => '+91 9876543211',
                'address' => '123 Main Street, Mumbai, Maharashtra 400001',
                'license_number' => 'MH0123456789',
                'license_expiry' => '2025-12-31',
                'license_type' => 'Heavy Motor Vehicle',
                'total_trips' => 150,
                'experience_years' => 8,
                'status' => 'off_duty',
            ],
            [
                'driver_id' => 'DRV002',
                'name' => 'Amit Singh',
                'blood_group' => 'A+',
                'phone' => '+91 9876543212',
                'emergency_phone' => '+91 9876543213',
                'address' => '456 Park Avenue, Delhi, Delhi 110001',
                'license_number' => 'DL0123456789',
                'license_expiry' => '2026-06-15',
                'license_type' => 'Light Motor Vehicle',
                'total_trips' => 200,
                'experience_years' => 10,
                'status' => 'on_duty',
            ],
            [
                'driver_id' => 'DRV003',
                'name' => 'Suresh Patel',
                'blood_group' => 'B+',
                'phone' => '+91 9876543214',
                'emergency_phone' => '+91 9876543215',
                'address' => '789 Gandhi Road, Ahmedabad, Gujarat 380001',
                'license_number' => 'GJ0123456789',
                'license_expiry' => '2025-08-20',
                'license_type' => 'Transport Vehicle',
                'total_trips' => 120,
                'experience_years' => 6,
                'status' => 'off_duty',
            ],
            [
                'driver_id' => 'DRV004',
                'name' => 'Vikram Sharma',
                'blood_group' => 'AB+',
                'phone' => '+91 9876543216',
                'emergency_phone' => '+91 9876543217',
                'address' => '321 Ring Road, Bangalore, Karnataka 560001',
                'license_number' => 'KA0123456789',
                'license_expiry' => '2026-03-10',
                'license_type' => 'Heavy Motor Vehicle',
                'total_trips' => 180,
                'experience_years' => 9,
                'status' => 'on_duty',
            ],
            [
                'driver_id' => 'DRV005',
                'name' => 'Mohan Reddy',
                'blood_group' => 'O-',
                'phone' => '+91 9876543218',
                'emergency_phone' => '+91 9876543219',
                'address' => '654 MG Road, Hyderabad, Telangana 500001',
                'license_number' => 'TS0123456789',
                'license_expiry' => '2025-11-05',
                'license_type' => 'Light Motor Vehicle',
                'total_trips' => 95,
                'experience_years' => 5,
                'status' => 'off_duty',
            ],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}