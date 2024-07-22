<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Pembayaran;
use App\Providers\Service\InvoiceService;
use App\Providers\Service\SantriService;
use App\Providers\Service\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    public function allInvoice(Request $request){
        $results = $this->Invoice->all_invoice();
        return DataTables::eloquent($results)
                ->addColumn('nis', function($row){
                    return $row->saba->nis;
                },true)
                ->addColumn('nama_lengkap', function($row){
                    return $row->saba->nama_lengkap;
                },true)
                ->addColumn('action', function($row){
                    $btn = '';
                    if ($row->status_tagihan == 'Lunas') {
                        $btn = '<a href="#" data-id="'.$row->id.'" class="btn btn-success btn-sm mt-1"><i class="lni lni-checkmark"></i></a>';
                    } else {
                        $btn = '<a href="#" data-id="'.$row->id.'" class="setActive btn btn-danger btn-sm mt-1"><i class="lni lni-checkmark"></i></a>';
                    }
                    return $btn;
                })
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    // Implementasi pencarian manual untuk kolom-kolom yang menggunakan relasi
                    if ($request->has('search.value')) {
                        $value = $request->input('search.value');
                        $query->where(function ($query) use ($value) {
                            $query->whereHas('saba', function ($query) use ($value) {
                                $query->where('nis', 'like', '%' . $value . '%')
                                      ->orWhere('nama_lengkap', 'like', '%' . $value . '%');
                            })
                            ->orWhere('nama_tagihan', 'like', '%' . $value . '%')
                            ->orWhere('jenis_tagihan', 'like', '%' . $value . '%')
                            ->orWhere('tahun_ajaran', 'like', '%' . $value . '%')
                            ->orWhere('bulan_ajaran', 'like', '%' . $value . '%');
                        });
                    }
                })
                ->toJson();
    }
    // get id pembayaran
    public function getPembayaranId($id){
        return $this->Setting->get_pembayaran_by_id($id);
    }
    // store invoice
    public function storeInvoicePendaftaran(InvoiceRequest $request){
        try {
            $request->validated();

            $nama_tagihan = $request->nama_tagihan;
            $pembayaran = $this->Setting->get_pembayaran_by_id($nama_tagihan);

            if ($pembayaran->jenis_pembayaran == 'ALL') {
                $nis = $request->nis;
                $santri = $this->Santri->getSantri($nis);
                $nisSudahAda = Invoice::query()->firstWhere('saba_id', $santri->id);
                if (!$santri) {
                    return response()->json(['message'=>'Nis Tidak DItemukan'],404);
                }elseif ($santri->status == 'Aktif') {
                    return response()->json(['message'=>'Nis Sudah Aktif'],404);
                }elseif ($nisSudahAda) {
                    return response()->json(['message'=>'Sudah Terdapata Tagihan Untuk Nis Tersebut'],404);
                }
                return $this->Invoice->store_pendataran_invoice($request, $santri);
            }elseif ($pembayaran->jenis_pembayaran == 'REGULAR') {
                return $this->Invoice->set_invoice_spp($request);
            }else{
                return $this->Invoice->set_invoice_sppKK($request);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }
    // set active santri
    public function setActiveSantri($id){
        return $this->Invoice->set_active($id);
    }
}
