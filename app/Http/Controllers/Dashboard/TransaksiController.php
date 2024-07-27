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
    public function sendWa(Request $request){
        return $this->Transaksi->sendNotifWa($request);
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
