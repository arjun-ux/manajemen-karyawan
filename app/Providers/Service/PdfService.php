<?php

namespace App\Providers\Service;


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
        // $saba = DB::table('sabas')->where('id', $id)->first();
        // $provinsi = IndoRegionService::getProvinsi($saba->provinsi);

        $results = [
            'kop' => $kop,
            // 'saba' => $saba,
            // 'provinsi' => $provinsi,
        ];
        $pdf = Pdf::loadView('dashboard.pdf.bukti_pendaftaran', ['results'=>$results]);
        $pdf->setPaper('A4', 'potrait');

        return $pdf->download('Bukti-Pendaftaran.pdf');
    }

}
