<?php

namespace Database\Seeders;

use App\Models\Saba;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'dev',
            'name' => 'Developer',
            'no_wa' => '082336659202',
            'password'=> Hash::make('arjun'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'Admin',
            'no_wa' => '082336659202',
            'password'=> Hash::make('asdasd'),
            'role' => 'admin'
        ]);
        // User::factory()->count(10000)->create();
        // Saba::factory()->count(10000)->create();

    }
}
