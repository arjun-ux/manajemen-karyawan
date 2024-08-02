<?php

namespace App\Providers\Service;

use App\Http\Requests\KamarRequest;
use App\Http\Requests\PembayaranRequest;
use App\Models\Kamar;
use App\Models\Saba;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class SettingsService extends ServiceProvider
{
    // setting kamar pesantren ----------------------------------------------------------------------------------------------
    // data kamar
    public static function get_all_kamar(){
        return Kamar::query(['id', 'nama_kamar', 'pembimbing']);
    }
    // store kamar
    public static function store_kamar(KamarRequest $request){
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
    public static function updateKamar(KamarRequest $r){
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
    // setting kamar santri
    public static function set_kamar_santri(Request $request, $id){
        $request->validate(['kamar_id'=>'required']);
        $santri = Saba::query()->firstWhere('id',$id);
        $santri->update(['kamar_id'=>$request->kamar_id]);
        return response()->json(['message'=>'Berhasil Memilih Kamar Santri']);
    }

    // jumlah penghuni kamar
    public static function penghuniKamar(){
        $data = DB::table('sabas as saba')
                ->join('kamars as kamar', 'saba.kamar_id', '=', 'kamar.id')
                ->select('kamar.id', 'kamar.nama_kamar', DB::raw('COUNT(*) as jumlah_saba'))
                ->groupBy('kamar.id', 'kamar.nama_kamar')
                ->get();
        // dd($data);
        return $data;
    }

    // setting pembayaran -------------------------------------------------------------------------
    public static function getAllPemba(){
        return Pembayaran::query(['id','nama_pembayaran','nominal_pembayaran','jenis_pembayaran']);
    }

    // get pembayaran by id
    public static function get_pembayaran_by_id($id){
        return Pembayaran::query()->firstWhere('id',$id);
    }
    // update pembayaran
    public static function updatePembayaran(PembayaranRequest $request){
        $data = Pembayaran::query()->firstWhere('id', $request->id);
        $data->update([
            'nama_pembayaran'=>$request->nama_pembayaran,
            'nominal_pembayaran'=>$request->nominal_pembayaran,
        ]);
        return response()->json(['message'=>'Berhasil Update Pembayaran']);
    }
    // delete jenis pembayaran
    public static function deletePembayaran($id){
        $data = Pembayaran::query()->firstWhere('id',$id);
        $data->delete();
        return response()->json(['message'=>'Berhasil Delete Data']);
    }
}
