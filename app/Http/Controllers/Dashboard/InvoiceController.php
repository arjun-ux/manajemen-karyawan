<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Pembayaran;
use App\Providers\Service\InvoiceService;
use App\Providers\Service\SantriService;
use App\Providers\Service\SettingsService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    protected $Invoice;
    protected $Setting;
    protected $Santri;
    public function __construct(InvoiceService $Invoice, SettingsService $Setting, SantriService $Santri)
    {
        $this->Invoice = $Invoice;
        $this->Setting = $Setting;
        $this->Santri = $Santri;
    }
    // index invoice
    public function indexInvoice(){
        $pembayaran =  Pembayaran::query()->get();
        return view('dashboard.admin.invoice.tagihan', compact('pembayaran'));
    }
    // datatable invoice
    public function allInvoice(){
        $results = $this->Invoice->all_invoice();
        return DataTables::eloquent($results)
                ->addColumn('nis', function($row){
                    return $row->saba->nis;
                })
                ->addColumn('nama_lengkap', function($row){
                    return $row->saba->nama_lengkap;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="#" data-id="'.$row->id.'" class="btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                    return $btn;
                })
                ->addIndexColumn()
                ->toJson();
    }
    // get id pembayaran
    public function getPembayaranId($id){
        return $this->Setting->get_pembayaran_by_id($id);
    }
    // store invoice
    public function storeInvoicePendaftaran(InvoiceRequest $request){
        $request->validated();
        $nis = $request->nis;
        $santri = $this->Santri->getSantri($nis);
        if (!$santri) {
            return response()->json(['message'=>'Nis Tidak DItemukan']);
        }
        $results = $this->Invoice->store_pendataran_invoice($request, $santri);
        return $results;
    }
}
