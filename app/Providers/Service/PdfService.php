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
        $saba = DB::table('sabas')->where('id', $id)->first();
        $provinsi = IndoRegionService::getProvinsi($saba->provinsi);

        $results = [
            'saba' => $saba,
            'provinsi' => $provinsi,
        ];

        // dd($results);




        $pdf = Pdf::loadView('dashboard.pdf.bukti_pendaftaran', ['results'=>$results]);
        return $pdf->stream('Bukti Pendaftaran.pdf');
    }

}
