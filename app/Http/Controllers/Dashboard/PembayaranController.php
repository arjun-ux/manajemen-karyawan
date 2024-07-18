<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePembayaranRequest;
use App\Providers\Service\SettingsService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    protected $Settings;
    public function __construct(SettingsService $Settings)
    {
        $this->Settings = $Settings;
    }
    // index
    public function index(){
        return view('dashboard.admin.pembayaran.index');
    }
    // get data all
    public function get_all(){
        $results = $this->Settings->getAllPemba();
        return DataTables::eloquent($results)
                        ->addColumn('action', function($row){
                            $btn = '<a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                            $btn .= ' <a href="#" data-id="'.$row->id.'" class="btn_delete btn btn-outline-danger btn-sm mt-1"><i class="lni lni-trash-can"></i></a>';
                            return $btn;
                        })
                        ->addIndexColumn()
                        ->toJson();
    }
    // store pembayaran
    public function store(Request $request){
        $request->validate([
            'jenis_pembayaran'=>'required',
            'jumlah'=>'required',
            'keterangan'=>'required',
        ]);
        return $this->Settings->store_pembayaran($request);
    }
    // get by id
    public function getById($id){
        $result = $this->Settings->get_pembayaran_by_id($id);
        return $result;
    }
}
