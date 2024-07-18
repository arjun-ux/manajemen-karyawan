<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\KamarRequest;
use App\Providers\RouteParamService;
use App\Providers\Service\SettingsService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KamarController extends Controller
{
    protected $Settings;
    public function __construct(SettingsService $Settings)
    {
        $this->Settings = $Settings;
    }
    // index kamar
    public function index(){
        return view('dashboard.admin.kamar.index');
    }
    // get data dengan ajax
    public function getKamar(){
        $results = $this->Settings->get_all_kamar();
        return DataTables::eloquent($results)
                ->addColumn('action', function($row){
                    $btn = '<a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                    $btn .= ' <a href="#" data-id="'.$row->id.'" class="btn_delete btn btn-outline-danger btn-sm mt-1"><i class="lni lni-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
    }
    // store
    public function store(KamarRequest $request){
        $valid = $request->validated();
        return $this->Settings->store_kamar($request);
    }
    // id kamar
    public function idKamar($id){
        $results = $this->Settings->getDataById($id);
        return $results;
    }
    // update
    public function update_kamar(KamarRequest $request){
        $valid = $request->validated();
        $results = $this->Settings->updateKamar($request);
        return $results;
    }
    // delete
    public function delete_kamar($id){
        return $this->Settings->deleteKamar($id);
    }
    // set kamar santri / update kamar santri
    public function setKamarSantri(Request $request, $id){
        $decodeId = RouteParamService::decode($id);
        $result = $this->Settings->set_kamar_santri($request,$decodeId);
        return $result;
    }
}
