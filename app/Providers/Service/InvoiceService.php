<?php

namespace App\Providers\Service;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Pembayaran;
use App\Models\Saba;
use App\Models\TahunAjaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use PhpParser\Node\Stmt\Return_;

class InvoiceService extends ServiceProvider
{
    // set active santri
    public static function set_active($id){
        // set active santri
        $data = Invoice::query()->with('saba')->firstWhere('id',$id);
        // store transaksi lunas
        Transaksi::create([
            'saba_id' => $data->saba_id,
            'tagihan_id' => $data->id,
            'nominal' => $data->nominal_tagihan,
            'tgl_transaksi' => now(),
        ]);
        $data->update(['status_tagihan'=>'Lunas']);
        $data->saba->update(['status'=>'Aktif']);
        return response()->json(['message'=>'Update Status Santri Aktif']);
    }
    // all Invoice
    public static function all_invoice(){
        $datas = Invoice::query()->orderBy('created_at','desc');
        return $datas;
    }
    // store invoice pendaftaran
    public static function store_pendataran_invoice(InvoiceRequest $request, $santri){
        $bulanTahun = $request->bulanTahun;
        list($tahun, $bulan) = explode('-', $bulanTahun);
        // Array untuk mengubah angka bulan menjadi huruf
        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $bulanHuruf = $namaBulan[$bulan];
        $pembayaran = SettingsService::get_pembayaran_by_id($request->nama_tagihan);
        // store invoice
        Invoice::query()->create([
            'saba_id' => $santri->id,
            'nama_tagihan' => $pembayaran->nama_pembayaran,
            'jenis_tagihan' => $pembayaran->jenis_pembayaran,
            'nominal_tagihan' => $pembayaran->nominal_pembayaran,
            'tahun_ajaran' => $tahun,
            'bulan_ajaran' => $bulanHuruf,
        ]);
        return response()->json(['message' => 'Berhasil Membuat Tagihan']);
    }
    // store invoice spp
    public static function set_invoice_spp(InvoiceRequest $request){
        $santris = SantriService::get_santri_SPP();
        if ($santris->isEmpty()) {
            return response()->json(['message'=>'Data Tidak Ditemukan'], 404);
        }
        // ambil pembayaran jenis regular
        $pembayaran = SettingsService::get_pembayaran_by_id($request->nama_tagihan);
        $bulanTahun = $request->bulanTahun;
        list($tahun, $bulan) = explode('-', $bulanTahun);
        // Array untuk mengubah angka bulan menjadi huruf
        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $bulanHuruf = $namaBulan[$bulan];
        foreach ($santris as $santri) {
            Invoice::create([
                'saba_id' => $santri->id,
                'nama_tagihan' => $pembayaran->nama_pembayaran,
                'jenis_tagihan' => $pembayaran->jenis_pembayaran,
                'nominal_tagihan' => $pembayaran->nominal_pembayaran,
                'tahun_ajaran' => $tahun,
                'bulan_ajaran' => $bulanHuruf,
            ]);
        }
        return response()->json(['message'=>'Berhasil Membuat Tagihan']);
    }

    // store invoice spp kk
    public static function set_invoice_sppKK(InvoiceRequest $request){
        $santris = SantriService::santriSPPKK();
        if ($santris->isEmpty()) {
            return response()->json(['message'=>'Data Tidak Ditemukan'], 404);
        }
        return response()->json([$santris]);
    }
}
