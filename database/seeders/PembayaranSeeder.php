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
            'jenis_pembayaran' => 'Pendaftaran',
            'jumlah' => 3180000,
            'keterangan' => 'Administrasi Awal Masuk Pesantren',
        ]);
        DB::table('pembayarans')->insert([
            'jenis_pembayaran' => 'SPP',
            'jumlah' => 975000,
            'keterangan' => 'Sumbangan Pembinaan Pendidikan',
        ]);
        DB::table('pembayarans')->insert([
            'jenis_pembayaran' => 'SPP Saudara Kandung',
            'jumlah' => 750000,
            'keterangan' => 'Sumbangan Pembinaan Pendidikan',
            'saudara_kandung' => 'YA',
        ]);
    }
}
