<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\Service\InvoiceService;
use App\Providers\Service\SantriService;
use App\Providers\Service\TransaksiService;
use Illuminate\Http\Request;
use Symfony\Component\Uid\NilUlid;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    protected $Invoice;
    protected $Santri;
    protected $Transaksi;
    public function __construct(InvoiceService $Invoice, SantriService $Santri, TransaksiService $Transaksi)
    {
        $this->Invoice = $Invoice;
        $this->Santri = $Santri;
        $this->Transaksi = $Transaksi;
    }
    //index
    public function index(){
        return view('dashboard.admin.transaksi.index');
    }
    // list transaksi
    public function listTransaksi(){
        return view('dashboard.admin.transaksi.daftar_transaksi');
    }
    // data list
    public function dataListTransaksi(Request $request){
        $data = $this->Transaksi->dataListTransaksi();
        return DataTables::eloquent($data)
                ->addColumn('nis', function ($data) {
                      return $data->saba->nis;
                })
                ->addColumn('nama_lengkap', function ($data) {
                      return $data->saba->nama_lengkap;
                })
                ->addColumn('tagihan', function ($data) {
                      return $data->invoice->nama_tagihan;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
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
                            ->orWhere('kode_transaksi', 'like', '%' . $value . '%')
                            ->orWhere('nominal', 'like', '%' . $value . '%')
                            ->orWhere('status', 'like', '%' . $value . '%');
                            $query->whereHas('invoice', function($query) use ($value){
                                $query->where('nama_tagihan', 'like', '%' . $value . '%');
                            });
                        });
                    }
                })
                ->toJson();
    }
    // cek tagihan pendaftaran
    public function cekTagihanPSB($nis){
        $santri = $this->Santri->get_santri_nis($nis);
        if (!$santri) {
            // Jika santri tidak ditemukan, tampilkan notifikasi error
            return response()->json(['message'=>'Nis tidak Ditemukan'],404);
        }
        $tagihan = $this->Invoice->getTagihanSantri($santri->id);
        if ($tagihan == null) {
            // Jika tagihan tidak ditemukan, tampilkan notifikasi error
            return response()->json(['message'=>'Tagihan untuk santri ini tidak ditemukan.'],404);
        }
        $data = [
            'santri' => $santri,
            'tagihan' => $tagihan
        ];
        return $data;
    }
    // store transaksi tagihan psb
    public function storeTagihanPSB(Request $request){
        return $this->Transaksi->store_tagihan_psb($request);
    }
    // cek tagihan spp
    public function cekTagihanSpp($nis){
        $santri = $this->Santri->get_santri_nis($nis);
        if (!$santri) {
            return response()->json(['message'=>'Nis Tidak Ditemukan'],404);
        }
        $tagihan = $this->Invoice->getTagihanSppSantri($santri->id);
        if ($tagihan == null) {
            return response()->json(['message'=>'Tagihan untuk santri ini tidak ditemukan.'],404);
        }
        $data = [
            'santri' => $santri,
            'tagihan' => $tagihan
        ];
        return $data;
    }
    // store transaksi spp
    public function storeTagihanSpp(Request $request){
        return $this->Transaksi->storeTransaksiSpp($request);
    }
}
