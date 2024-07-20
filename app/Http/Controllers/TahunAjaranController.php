<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Providers\Service\InvoiceService;
use App\Providers\Service\SantriService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\ReturnTypePass;
use Yajra\DataTables\Facades\DataTables;

class TahunAjaranController extends Controller
{
    protected $Santri;
    protected $invoice;
    public function __construct(SantriService $Santri, InvoiceService $invoice)
    {
        $this->Santri = $Santri;
        $this->invoice = $invoice;
    }
    // index daftar tahun ajaran-----------------------------------------------
    public function index(){
        $jenis_pembayaran = Pembayaran::query()->get();
        return view('dashboard.admin.invoice.tahun_ajaran', compact('jenis_pembayaran'));
    }
    // data spp tahun ajaran
    public function dataTahunAjaran(){
        $data = $this->invoice->dataAll();
        // return response()->json([$data]);
        return DataTables::of($data)
                        ->addColumn('pembayaran', function ($row) {
                            return $row->Pembayaran->jenis_pembayaran;
                        })
                        ->addColumn('action', function($row){
                            $btn = ' <a href="#" data-id="'.$row->id.'" class="setTagihan btn btn-outline-warning btn-sm mt-1"><i class="lni lni-checkmark"></i></a>';
                            $btn .= ' <a href="#" data-id="'.$row->id.'" class="sendNotif btn btn-outline-success btn-sm mt-1"><i class="lni lni-whatsapp"></i></a>';
                            $btn .= ' <a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                            $btn .= ' <a href="#" data-id="'.$row->id.'" class="btn_delete btn btn-outline-danger btn-sm mt-1"><i class="lni lni-trash-can"></i></a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }
    // store tahun ajaran
    public function store(Request $request){
        return $this->invoice->store_spp_ajaran($request);
    }
    // set tagihan tahun ajaran ke santri
    public function set_tagihan($id){
        $data = DB::table('tahun_ajarans as ta')
                    ->join('pembayarans as pemb', 'ta.pembayaran_id','=','pemb.id')
                    ->where('ta.id', $id)
                    ->first();
        if ($data->saudara_kandung == 'YA') {
            return $this->invoice->setTagihan($id);
        }
        return $this->invoice->setTagihanRegular($id);
    }
}
