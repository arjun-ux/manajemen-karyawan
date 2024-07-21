<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembayarans')->insert([
            'nama_pembayaran' => 'PSB 2024-2025',
            'nominal_pembayaran' => 3300000,
            'jenis_pembayaran' => 'ALL',
        ]);
        DB::table('pembayarans')->insert([
            'nama_pembayaran' => 'SPP',
            'nominal_pembayaran' => 975000,
            'jenis_pembayaran' => 'REGULAR',
        ]);
        DB::table('pembayarans')->insert([
            'nama_pembayaran' => 'SPP SAUDARA KK',
            'nominal_pembayaran' => 750000,
            'jenis_pembayaran' => 'SAUDARA KK',
        ]);
    }
}
