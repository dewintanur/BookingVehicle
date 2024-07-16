<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder UserSeeder dan VehicleSeeder
        $this->call([
            UserSeeder::class,
            VehicleSeeder::class,
        ]);
    }
}
