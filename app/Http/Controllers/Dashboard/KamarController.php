<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KamarController extends Controller
{
    // index kamar
    public function index(){
        return view('dashboard.admin.kamar.index');
    }
    // get data dengan ajax
    public function getKamar(){
        $datas = DB::table('kamars')->get(['id','nama_kamar','pembimbing']);
        return DataTables::of($datas)
                ->addIndexColumn()
                ->toJson();
    }
}
