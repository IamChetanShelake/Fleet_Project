<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Franchise;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates 3 franchise-specific admin users
     */
    public function run(): void
    {
        // Get Super Admin role ID dynamically
        $superAdminRole = Role::where('slug', 'super-admin')->first();
        $roleId = $superAdminRole ? $superAdminRole->id : null;

        // Get franchises
        $qtrFranchise = Franchise::where('country_name', 'Qatar')->first();
        $sauFranchise = Franchise::where('country_name', 'Saudi Arabia')->first();
        $uaeFranchise = Franchise::where('country_name', 'United Arab Emirates')->first();

        // Create or update Qatar Admin
        if ($qtrFranchise && $roleId) {
            User::firstOrCreate(
                ['email' => 'qtr@gmail.com'],
                [
                    'name' => 'Qatar Admin',
                    'password' => Hash::make('qtradmin'),
                    'role_id' => $roleId,
                    'franchise_id' => $qtrFranchise->id,
                    'mobile' => '+974 1234 5678',
                    'department' => 'Operations',
                    'position' => 'Franchise Manager',
                    'date_of_joining' => now(),
                    'status' => 'active',
                ]
            );
        }

        // Create or update Saudi Arabia Admin
        if ($sauFranchise && $roleId) {
            User::firstOrCreate(
                ['email' => 'sau@gmail.com'],
                [
                    'name' => 'Saudi Arabia Admin',
                    'password' => Hash::make('sauadmin'),
                    'role_id' => $roleId,
                    'franchise_id' => $sauFranchise->id,
                    'mobile' => '+966 50 123 4567',
                    'department' => 'Operations',
                    'position' => 'Franchise Manager',
                    'date_of_joining' => now(),
                    'status' => 'active',
                ]
            );
        }

        // Create or update UAE Admin
        if ($uaeFranchise && $roleId) {
            User::firstOrCreate(
                ['email' => 'uae@gmail.com'],
                [
                    'name' => 'UAE Admin',
                    'password' => Hash::make('uaeadmin'),
                    'role_id' => $roleId,
                    'franchise_id' => $uaeFranchise->id,
                    'mobile' => '+971 50 123 4567',
                    'department' => 'Operations',
                    'position' => 'Franchise Manager',
                    'date_of_joining' => now(),
                    'status' => 'active',
                ]
            );
        }

        // Create legacy admin (for backward compatibility)
        if ($roleId) {
            User::firstOrCreate(
                ['email' => 'admin@qwikhom.com'],
                [
                    'name' => 'Super Admin',
                    'password' => Hash::make('password'),
                    'role_id' => $roleId,
                    'franchise_id' => null, // Can access all franchises
                    'mobile' => '+000 0000 0000',
                    'department' => 'Management',
                    'position' => 'Super Admin',
                    'date_of_joining' => now(),
                    'status' => 'active',
                ]
            );
        }
    }
}
