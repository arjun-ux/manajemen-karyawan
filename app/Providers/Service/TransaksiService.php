<?php

namespace App\Providers\Service;

use Illuminate\Support\Str;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class TransaksiService extends ServiceProvider
{
    public static function traksaksiBulanIni(){
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        // Query untuk mendapatkan transaksi dalam bulan ini
        $transaksi = Transaksi::query()
                ->whereBetween('tgl_transaksi', [$startOfMonth, $endOfMonth]);
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
