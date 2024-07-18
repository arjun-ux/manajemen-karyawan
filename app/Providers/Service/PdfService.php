<?php

namespace App\Providers\Service;

use App\Models\OrangTua;
use App\Providers\RouteParamService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class PdfService extends ServiceProvider
{
    // print pdf di pendaftaran / setelah input data / Bukti pendaftaran
    public static function PdfPendaftaran($id){
        $id = RouteParamService::decode($id);
        $imagePath = public_path('img/kop.png');
        $kop = file_get_contents($imagePath);
        $saba = DB::table('sabas')->where('id', $id)->first();
        $noDaftar = substr($saba->nis, -4);
        $provinsi = IndoRegionService::getProvinsi($saba->provinsi);
        $kabupaten = IndoRegionService::getKota($saba->kabupaten);
        $kecamatan = IndoRegionService::getKecamatan($saba->kecamatan);
        $desa = IndoRegionService::getDesa($saba->desa);
        $ortu = DB::table('orang_tuas')->where('saba_id', $id)->first();
        $pendidikanA = PendidikanService::getPendidikan($ortu->pendidikan_ayah);
        $pekerjaanA = PekerjaanService::getPekerjaan($ortu->pekerjaan_ayah);
        $pendidikanI = PendidikanService::getPendidikan($ortu->pendidikan_ibu);
        $pekerjaanI = PekerjaanService::getPekerjaan($ortu->pekerjaan_ibu);
        $wali = DB::table('wali_sabas')->where('saba_id', $id)->first();
        $asal_sekolah = DB::table('saba_masuk_pondoks')->where('saba_id', $id)->first();
        $results = [
            'no_daftar' => $noDaftar,
            'kop' => $kop,
            'saba' => $saba,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'pendidikanA' => $pendidikanA,
            'pendidikanI' => $pendidikanI,
            'pekerjaanA' => $pekerjaanA,
            'pekerjaanI' => $pekerjaanI,
            'ortu' => $ortu,
            'wali' => $wali,
            'asal_sekolah' => $asal_sekolah,
        ];
        // dd($results);
        $pdf = Pdf::loadView('dashboard.pdf.bukti_pendaftaran', ['results'=>$results]);
        $pdf->setPaper('F4', 'potrait');
        return $pdf->stream('Bukti-Pendaftaran.pdf');
    }

}
