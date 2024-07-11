<?php

namespace App\Providers\Service;

use App\Models\Pendidikan;
use Illuminate\Support\ServiceProvider;

class PendidikanService extends ServiceProvider
{
    // get nama pendidikan
    public static function getPendidikan($id){
        $data = Pendidikan::where('id',$id)->first(['nama_pendidikan']);
        return $data;
    }
}
