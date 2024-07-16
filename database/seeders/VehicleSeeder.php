<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            ['name' => 'Truck 1', 'type' => 'goods', 'is_company_owned' => true],
            ['name' => 'Car 1', 'type' => 'people', 'is_company_owned' => false],
        ]);
    }
}
