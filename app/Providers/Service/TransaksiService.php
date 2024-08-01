<?php

namespace App\Providers\Service;

use App\Models\Invoice;
use Illuminate\Support\Str;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class TransaksiService extends ServiceProvider
{
    // send notif wa
    public static function sendNotifWa(Request $request){
        // return response()->json($request->all());
        $user = User::query()->where('username', $request->nis_santri)->first();
        $message = 'Pembayaran '.$request->nama_tagihan. ' ' .$request->bulan_tahun. ' Atas Nama ' . $user->name. ' Telah Di Input Ke Sistem';
        WhatsAppService::sendNotif($user->no_wa, $message);
        return response()->json(['message'=>'Berhasil Send Notif Wa']);
    }
    // all traksaksi
    public static function getAll(){
        return Transaksi::all();
    }
    public static function traksaksiBulanIni($request){
        $startOfMonth = $request->awal;
        $tahunAjaran = date('Y', strtotime($startOfMonth));
        $bulanAjaran = date('m', strtotime($startOfMonth));
        $kamar_id = $request->kamar_id;
        $jenis_tagihan = $request->jenis_tagihan;

        // Array untuk memetakan angka bulan ke nama bulan
        $angkaBulanKeNama = [
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
        $namaBulan = $angkaBulanKeNama[$bulanAjaran];
        // return $namaBulan;
        // Query dasar untuk mendapatkan transaksi dalam rentang tanggal yang ditentukan
        $transaksi = Invoice::query()
            ->with('saba')
            // ->with('invoice')
            // ->whereBetween('tgl_transaksi', [$startOfMonth, $endOfMonth]);
            ->where('bulan_ajaran', $namaBulan)
            ->where('tahun_ajaran', $tahunAjaran);
        // Jika parameter kamar ada, tambahkan filter untuk kamar
        if ($kamar_id) {
            $transaksi->whereHas('saba', function ($query) use ($kamar_id) {
                $query->where('kamar_id', $kamar_id);
            });
        }

        // Jika parameter jenis_tagihan ada, tambahkan filter untuk jenis_tagihan
        if ($jenis_tagihan) {
            $transaksi->where('jenis_tagihan', $jenis_tagihan);

        }
        return $transaksi;
    }
    // data list transaksi
    public static function dataListTransaksi(){
        $transaksi = Transaksi::query()
                            ->with('saba')
                            ->with('invoice')
                            ->orderBy('created_at', 'desc');
        return $transaksi;
    }
    // store transaksi tagihan spp
    public static function storeTransaksiSpp(Request $request){
        $data = InvoiceService::getTagihanSppSantri($request->sabaId);
        $transaksi = Transaksi::create([
            'kode_transaksi' => Str::random(10),
            'saba_id' => $data->saba_id,
            'tagihan_id' => $data->id,
            'nominal' => $data->nominal_tagihan,
            'tgl_transaksi' => now(),
            'status' => 'Lunas'
        ]);
        $data->update(['status_tagihan'=>'Lunas']);
        $callback = [
            'req' => $request->all(),
            'transaksi' => $transaksi,
            'data' => $data,
        ];
        return response()->json(['message'=>'Transaksi Berhasil','back'=>$callback]);
    }
    // store transaksi tagihan psb
    public static function store_tagihan_psb(Request $request){

        $invoice = InvoiceService::getTagihanSantri($request->sabaId);
        $nt = intval($invoice->nominal_tagihan); // nominal tagihan

        // jika datanya sudah 0 maka kembalikan error bahwa sudah lunas
        if ($nt == 0) {
            return response()->json(['message'=>'Data Ini Sudah Lunas'],404);
        }

        $nominal_cleaned = str_replace(['Rp ', '.'], '', $request['nominal']); //pembersihan Rp
        $nb = intval($nominal_cleaned); // nominal bayar
        $n = $nt - $nb; // hasil pengurangan

        if ($nb > $nt) {
            return response()->json(['message'=>'Jumlah Bayar Tidak Boleh Melebihi Tagihan'],404);
        }

        $santri = SantriService::get_santri_id($request->sabaId);
        // jika ada sisa maka
        if (!$n == 0) {
            // update invoice
            $invoice->update([
                'nominal_tagihan'=> $n,
                'status_tagihan' => 'Cicilan',
            ]);
            // update status santri
            $santri->update(['status'=>'Pending']);
            // create transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => Str::random(10),
                'saba_id' => $request->sabaId,
                'tagihan_id' => $request->tagihanId,
                'nominal' => $nominal_cleaned,
                'tgl_transaksi' => now(),
                'status' => 'Cicilan',
            ]);

            $callback = [
                'req' => $request->all(),
                'transaksi' => $transaksi,
            ];
            return response()->json(['message'=>'Transaksi Berhasil','back'=>$callback]);
        }
        // jika tidak ada sisa maka
        else {
            // update invoice
            $invoice->update([
                'nominal_tagihan'=> $n,
                'status_tagihan' => 'Lunas',
            ]);
            // update status santri
            $santri->update(['status'=>'Aktif']);
            // create transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => Str::random(10),
                'saba_id' => $request->sabaId,
                'tagihan_id' => $request->tagihanId,
                'nominal' => $nominal_cleaned,
                'tgl_transaksi' => now(),
                'status' => 'Lunas',
            ]);
            $callback = [
                'req' => $request->all(),
                'transaksi' => $transaksi,
            ];
            return response()->json(['message'=>'Transaksi Berhasil','back'=>$callback]);
        }

    }
}
