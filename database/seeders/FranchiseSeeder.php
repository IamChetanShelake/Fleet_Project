<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Franchise;

class FranchiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates exactly 3 franchises: QTR, SAU, UAE
     */
    public function run(): void
    {
        $franchises = [
            [
                'country_name' => 'Qatar',
                'currency' => 'QAR',
                'has_tax' => false,
                'tax_percentage' => 0.00,
                'is_active' => true,
            ],
            [
                'country_name' => 'Saudi Arabia',
                'currency' => 'SAR',
                'has_tax' => true,
                'tax_percentage' => 15.00,
                'is_active' => true,
            ],
            [
                'country_name' => 'United Arab Emirates',
                'currency' => 'AED',
                'has_tax' => true,
                'tax_percentage' => 5.00,
                'is_active' => true,
            ],
        ];

        foreach ($franchises as $franchise) {
            Franchise::firstOrCreate(
                ['country_name' => $franchise['country_name']],
                $franchise
            );
        }
    }
}
