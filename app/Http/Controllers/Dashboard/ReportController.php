<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Providers\Service\TransaksiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    //index bulanan
    public function ReportBulanan(){
        $kamar = Kamar::query()->get(['id','nama_kamar','pembimbing']);
        $jenis_tagihan = Pembayaran::query()->get();
        return view('dashboard.admin.report.bulanan', compact('kamar','jenis_tagihan'));
    }
    public function dataBulanan(Request $request){
        $request->validate([
            'awal' => 'required',
            'akhir' => 'required',
        ],[
            'awal.required' => 'Select Start Of Range',
            'akhir.required' => 'Select End Of Range'
        ]);
        $bulanIni =  TransaksiService::traksaksiBulanIni($request);
        // return response()->json($bulanIni);
        return DataTables::eloquent($bulanIni)
                    ->addColumn('nama_lengkap', function($data){
                        return $data->saba->nama_lengkap;
                    })
                    ->addColumn('nama_tagihan', function($data){
                        return $data->invoice->nama_tagihan;
                    })
                    ->addColumn('bulan', function($data){
                        return $data->invoice->bulan_ajaran;
                    })
                    ->addColumn('tahun', function($data){
                        return $data->invoice->tahun_ajaran;
                    })
                    ->addIndexColumn()
                    ->toJson();
    }
}
