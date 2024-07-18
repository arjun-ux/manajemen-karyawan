<?php

namespace App\Providers\Service;

use App\Models\Kamar;
use App\Models\Saba;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class SettingsService extends ServiceProvider
{
    // setting kamar pesantren ----------------------------------------------------------------------------------------------
    // data kamar
    public static function get_all_kamar(){
        return Kamar::query(['id', 'nama_kamar', 'pembimbing']);
    }
    // store kamar
    public static function store_kamar(Request $request){
        $request->validate([
            'nama_kamar' => 'required',
            'pembimbing' => 'required',
        ]);
        Kamar::create([
            'nama_kamar' => $request->nama_kamar,
            'pembimbing' => $request->pembimbing,
        ]);

        return response()->json(['message'=>'Berhasil Input Data']);
    }
    // get id kamar
    public static function getDataById($id){
        return Kamar::query()->firstWhere('id',$id);
    }
    // update kamaar
    public static function updateKamar(Request $r){
        $r->validate([
            'nama_kamar'=>'required',
            'pembimbing'=>'required',
        ]);
        $kamar = Kamar::query()->firstWhere('id', $r->id);
        $kamar->update([
            'nama_kamar'=>$r->nama_kamar,
            'pembimbing'=>$r->pembimbing,
        ]);
        return response()->json(['message'=>'Berhasil Update Data']);
    }
    // delete kamar
    public static function deleteKamar($id){
        $kamar = Kamar::query()->firstWhere('id',$id);
        $kamar->delete();
        return response()->json(['message'=>'Data Berhasil Di Hapus']);
    }
    // settignkamar santri
    public static function set_kamar_santri(Request $request, $id){
        $request->validate(['kamar_id'=>'required']);
        $santri = Saba::query()->firstWhere('id',$id);
        $santri->update(['kamar_id'=>$request->kamar_id]);
        return response()->json(['message'=>'Berhasil Memilih Kamar Santri']);
    }
}
