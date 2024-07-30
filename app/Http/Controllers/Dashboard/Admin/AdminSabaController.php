<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SantriRequest;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Saba;
use Illuminate\Http\Request;
use App\Providers\RouteParamService as routeParam;
use App\Providers\Service\IndoRegionService;
use App\Providers\Service\SantriService;
use App\Providers\Service\WhatsAppService;
use Illuminate\Support\Facades\Log;
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
    public function getAllSantri()
    {
        try {
            $data = $this->santri->getAll();

            return DataTables::eloquent($data)
                ->addColumn('action', function($row){
                    $btn = '<a href="/show-saba/'.routeParam::encode($row->id).'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                    $btn .= ' <a href="/lihat-santri/'.routeParam::encode($row->id).' " class="btn btn-outline-warning btn-sm mt-1"><i class="lni lni-empty-file"></i></a>';
                    $btn .= ' <a href="#" data-id="'.$row->id.'" class="btn-nonAktif btn btn-outline-danger btn-sm mt-1"><i class="lni lni-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        } catch (\Exception $e) {
            // Tangani exception dengan pesan yang relevan atau lakukan logging
            Log::error('Error saat mengambil data santri: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memproses permintaan.'], 500);
        }
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
    public function store(SantriRequest $request){
        $request->validated();
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
        $decodeId = routeParam::decode($id);
        if ($decodeId) {
            $results = $this->santri->getById($decodeId);
        }else{
            $results = $this->santri->getById($id);
        }

        $provinsi = $this->indo->Provinsi();
        return view('dashboard.admin.data-saba-all.edit', compact('provinsi', 'results'));
    }
    // update saba
    public function updateSaba(SantriRequest $request, $id){
        $request->validated();
        $data = $this->santri->updateSantri($request,$id);
        return $data;
    }
    // hanya lihat dan akan export pdf data diri santri
    public function lihatSantri($id){
        $decodeId = routeParam::decode($id);
        if ($decodeId) {
            $datas = $this->santri->lihatSantri($decodeId);
        }else{
            $datas = $this->santri->lihatSantri($id);
        }
        return view('dashboard.admin.data-saba-all.lihat_santri', compact('datas'));
    }
    // get berkas
    public function lihatBerkas($sid){
        $res = $this->santri->getBerkas($sid);
        return response()->json(['data'=>$res]);
    }
    // non aktifkan santri boyong
    public function setNonActive($id){
        $santri = Saba::where('id', $id)->first();
        // return response()->json($santri);
        $santri->update(['status'=>'Boyong']);
        return response()->json(['message'=>"Berhasil Boyong"], 200);
    }
    public function alumni(){
        return view('dashboard.admin.alumni.index');
    }
    public function DataAlumni(){
        $data = Saba::query()->where('status', 'Boyong');
        return DataTables::eloquent($data)
                ->addIndexColumn()
                ->toJson();
    }
}
