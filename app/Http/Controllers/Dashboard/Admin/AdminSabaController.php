<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Saba;
use Illuminate\Http\Request;
use App\Providers\RouteParamService as routeParam;
use App\Providers\Service\IndoRegionService;
use App\Providers\Service\SantriService;
use App\Providers\Service\WhatsAppService;
use Yajra\DataTables\Facades\DataTables;


class AdminSabaController extends Controller
{
    protected $santri;
    protected $indo;
    protected $whatsApp;

    public function __construct(SantriService $santri, IndoRegionService $indo, WhatsAppService $whatsApp)
    {
        $this->santri = $santri;
        $this->indo = $indo;
        $this->whatsApp = $whatsApp;
    }
    // index
    public function index()
    {
        return view('dashboard.admin.data-saba-all.index');
    }
    // datatable santri all
    public function getAllSantri(){
        $data = $this->santri->getAll();
        return DataTables::of($data)
            ->addColumn('action', function($row){
                $btn = '<a href="/show-saba/'.routeParam::encode($row->id).'" class="btn_edit btn btn-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                $btn .= ' <a href="/lihat-santri/'.routeParam::encode($row->id).' " class="btn_pembayaran btn btn-warning btn-sm mt-1"><i class="lni lni-empty-file"></i></a>';
                $btn .= ' <a href="#" class="btn_delete btn btn-danger btn-sm mt-1"><i class="lni lni-trash-can "></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    // create santri
    public function create(){
        $provinsi = $this->indo->Provinsi();
        $pekerjaan = Pekerjaan::all();
        $pendidikan = Pendidikan::all();
        return view('dashboard.admin.data-saba-all.create', compact('provinsi','pekerjaan','pendidikan'));
    }
    // cek saudara kandung
    public function cekSaudaraKandung($nokk){
        $data = Saba::where('nokk', $nokk)->get(['nokk','id']);

        if ($data->isEmpty()) {
            return response()->json(['status' => 404]);
        }else {
            return response()->json([
                'message' => 'Terdapat Data Saudara Kandung',
                'data' => $data,
            ]);
        }
    }
    // update saudara kandung
    public function updateSaudaraKandung(Request $request){
        $items = $request->data;
        foreach ($items as $val) {
            $id = $val['id'];
            Saba::where('id', $id)->update(['saudara_kandung' => 'YA']);
        }
        return response()->json(['message' => 'Berhasil Update Data Saudara', 'item'=>$items]);
    }
    // store santri
    public function store(Request $request){
        $data = $this->santri->StoreSantri($request);
        return $data;
    }
    // create berkas
    public function createBerkas(){
        return view('dashboard.admin.data-saba-all.berkas');
    }
    // store berkas
    public function store_berkas(Request $request){
        $data = $this->santri->storeBerkas($request);
        return $data;
    }
    // detail Saba
    public function showSaba($id){
        $id = routeParam::decode($id);
        $data = $this->santri->getById($id);
        $provinsi = $this->indo->Provinsi();
        return view('dashboard.admin.data-saba-all.edit', compact('provinsi', 'data'));
    }
    // update saba
    public function updateSaba(Request $request, $id){
        $data = $this->santri->updateSantri($request,$id);
        return $data;
    }
    // hanya lihat dan akan export pdf data diri santri
    public function lihatSantri($id){
        $id = routeParam::decode($id);
        $datas = $this->santri->getById($id);
        // dd($datas);
        // $provinsi = $this->indo->Provinsi();
        return view('dashboard.admin.data-saba-all.lihat_santri', compact('datas'));
    }
}
