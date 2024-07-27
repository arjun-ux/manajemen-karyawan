<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\Service\TransaksiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    //index bulanan
    public function ReportBulanan(){
        return view('dashboard.admin.report.bulanan');
    }
    public function dataBulanan(Request $request){
        $bulanIni =  TransaksiService::traksaksiBulanIni($request);
        // return $bulanIni;
        return DataTables::eloquent($bulanIni)
                    ->addIndexColumn()
                    ->toJson();
    }
    //index tahunan
    public function ReportTahunan(){
        return view('dashboard.admin.report.tahunan');
    }
}
