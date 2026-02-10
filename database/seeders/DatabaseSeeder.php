<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first
        $this->call(RoleSeeder::class);

        // Seed franchises (exactly 3: QTR, SAU, UAE)
        $this->call(FranchiseSeeder::class);

        // Seed franchise-specific admin users
        $this->call(AdminUserSeeder::class);

        // Note: ContactSubmissionSeeder and DriverSeeder removed due to missing models
        // These can be added back when the models are created
    }
}
