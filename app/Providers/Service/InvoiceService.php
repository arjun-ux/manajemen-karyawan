<?php

namespace App\Providers\Service;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Transaksi;
use Illuminate\Support\ServiceProvider;

class InvoiceService extends ServiceProvider
{
    // get tagihan Santri
    public static function getTagihanSantri($id){
        return Invoice::query()->where('saba_id',$id)->first(['id','saba_id','nama_tagihan','nominal_tagihan']);
    }
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
        $datas = Invoice::query()->orderBy('id','desc');
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
        // ambil data bulan tahun invoice
        $bulanTahunInvoice = Invoice::where('bulan_ajaran', $bulanHuruf)
                            ->where('tahun_ajaran',$tahun)
                            ->where('nama_tagihan', $pembayaran->nama_pembayaran)
                            ->first();
        // cek apakah bulan tahun sudah ada invoice
        if ($bulanTahunInvoice) { // jika sudah ada, maka kembalikan error
            return response()->json(['message'=>'Data Bulan Ini Sudah Ada'], 404);
        }
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
        return response()->json(['message'=>'Berhasil Membuat Tagihan Spp Regular']);
    }

    // store invoice spp kk
    public static function set_invoice_sppKK(InvoiceRequest $request){
        $santris = SantriService::santriSPPKK();
        // return response()->json([$santris]);
        if ($santris->isEmpty()) {
            return response()->json(['message'=>'Data Tidak Ditemukan'], 404);
        }
        // ambil pembayaran jenis saudara kk
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
        // ambil data invoice bulan
        $bulanTahunInvoice = Invoice::where('bulan_ajaran', $bulanHuruf)
                            ->where('tahun_ajaran',$tahun)
                            ->where('nama_tagihan', $pembayaran->nama_pembayaran)
                            ->first();
        // cek apakah bulan tahun sudah ada invoice
        if ($bulanTahunInvoice) { // jika sudah ada, maka kembalikan error
            return response()->json(['message'=>'Data Bulan Ini Sudah Ada'], 404);
        }
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
        return response()->json(['message'=>'Berhasil Membuat Tagihan Spp Saudara']);
    }
}
