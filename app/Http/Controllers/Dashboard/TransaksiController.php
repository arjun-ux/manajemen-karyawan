<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\Service\InvoiceService;
use App\Providers\Service\SantriService;
use App\Providers\Service\TransaksiService;
use Illuminate\Http\Request;

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
    // cek tagihan pendaftaran
    public function cekTagihanPSB($nis){
        $santri = $this->Santri->get_santri_nis($nis);
        $tagihan = $this->Invoice->getTagihanSantri($santri->id);
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
        return $santri;
    }
}
