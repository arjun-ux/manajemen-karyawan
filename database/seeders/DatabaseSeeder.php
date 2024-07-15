<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $roles = [
            [
                'name' => 'admin',
            ],
            [
                'name' => 'saba',
                ]
            ];
            DB::table('roles')->insert($roles);
            $this->call(IndoRegionProvinceSeeder::class);
            $this->call(IndoRegionRegencySeeder::class);
            $this->call(IndoRegionDistrictSeeder::class);
            $this->call(IndoRegionVillageSeeder::class);
            $this->call(PekerjaanSeeder::class);
            $this->call(PendidikanSeeder::class);
            $this->call(PembayaranSeeder::class);
            $this->call(UserSeeder::class);
    }
}
