<?php

namespace App\Providers\Service;

use App\Models\Pekerjaan;
use Illuminate\Support\ServiceProvider;

class PekerjaanService extends ServiceProvider
{
    // get nama pekerjaan
    public static function getPekerjaan($id){
        $data = Pekerjaan::where('id', $id)->first(['nama_pekerjaan']);
        return $data;
    }
}
