<?php

namespace App\Providers\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class SettingsService extends ServiceProvider
{
    // setting kamar pesantren ----------------------------------------------------------------------------------------------
    // data kamar
    public static function get_all_kamar(){
        return DB::table('kamars')->newQuery(['id', 'nama_kamar', 'pembimbing']);
    }
}
