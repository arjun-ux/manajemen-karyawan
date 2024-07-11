<?php

namespace App\Providers\Service;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class IndoRegionService extends ServiceProvider
{
    // kota all
    public static function Provinsi(){
        $data = DB::table('provinces')->get(['name','id']);
        return $data;
    }
    // fetch-kota
    public static function Kota($request){
        $data['kota'] = DB::table('regencies')->where('province_id', $request->province_id)
            ->get(['name','id']);
        return $data;
    }
    // fetch-kecamatan
    public static function Kecamatan($request){
        $data['kecamatan'] = DB::table('districts')->where('regency_id', $request->regency_id)
            ->get(['name', 'id']);
        return $data;
    }
    // fetch-desa
    public static function Desa($request){
        $data['desa'] = DB::table('villages')->where('district_id', $request->district_id)
            ->get(['name', 'id']);
        return $data;
    }
    // nama provinsi
    public static function getProvinsi($id){
        $data = Province::where('id', $id)->first();
        return $data;
    }
    // nama kabupaten / kota
    public static function getKota($id){
        $data = Regency::where('id', $id)->first();
        return $data;
    }
    // nama kecamatan
    public static function getKecamatan($id){
        $data = District::where('id', $id)->first();
        return $data;
    }
    // nama desa
    public static function getDesa($id){
        $data = Village::where('id',$id)->first();
        return $data;
    }
}
