<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Full system access with all permissions',
                'is_active' => true,
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrative access with most permissions',
                'is_active' => true,
            ],
            [
                'name' => 'Supervisor',
                'slug' => 'supervisor',
                'description' => 'Supervisory role with team management permissions',
                'is_active' => true,
            ],
            [
                'name' => 'Account Staff',
                'slug' => 'account-staff',
                'description' => 'Accounting and financial operations staff',
                'is_active' => true,
            ],
            [
                'name' => 'Country Finance Aid',
                'slug' => 'country-finance-aid',
                'description' => 'Country-level financial assistance coordinator',
                'is_active' => true,
            ],
            [
                'name' => 'Franchise Manager',
                'slug' => 'franchise-manager',
                'description' => 'Manages franchise operations and partnerships',
                'is_active' => true,
            ],
            [
                'name' => 'Co-Ordinator',
                'slug' => 'coordinator',
                'description' => 'Coordinates operations and logistics',
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
