<?php

namespace App\Providers\Service;

use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use PhpParser\Node\Stmt\Return_;

class InvoiceService extends ServiceProvider
{
    // data tahun ajaran all
    public static function dataAll(){
        return TahunAjaran::query()->with('Pembayaran')->orderBy('id','desc')->get();
    }
    // store data ajaran
    public static function store_spp_ajaran(Request $request){
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'pembayaran_id' => 'required',
        ]);
        TahunAjaran::create([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'pembayaran_id' => $request->pembayaran_id,
            'total_uang' => 0,
        ]);
        return response()->json(['message'=>'Berhasil Input Data']);
    }
    // set tagihan di halaman tahun ajaran saudara kandung
    public static function setTagihan($id){
        // ambil data santri yang saudara kandung
        $santri = SantriService::getSantri()->where('saudara_kandung','=','YA');
        // hitung jumlahnya untuk update tahun ajaran
        $count = $santri->count();
        // update jumlah santri tahun ajaran
        $tahunAjaran = TahunAjaran::query()->where('id',$id)->first();
        $tahunAjaran->update(['jumlah_santri'=>$count]);
        //
        return response()->json(['message'=>'Saudara kandung', 'data'=>$tahunAjaran]);
    }
    // set tagihan halaman tahun ajaran (spp regular)
    public static function setTagihanRegular($id){
        $santri = SantriService::getSantri()->where('saudara_kandung','=','TIDAK');
        $count = $santri->count();
        // update jumlah santri tahun ajaran
        $tahunAjaran = TahunAjaran::query()->where('id',$id)->first();
        $tahunAjaran->update(['jumlah_santri'=>$count]);
        //
        return response()->json(['message'=>'Saudara kandung', 'data'=>$santri]);
    }
}
