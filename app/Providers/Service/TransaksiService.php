<?php

namespace App\Providers\Service;

use Illuminate\Support\Str;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class TransaksiService extends ServiceProvider
{
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
            Transaksi::create([
                'kode_transaksi' => Str::random(10),
                'saba_id' => $request->sabaId,
                'tagihan_id' => $request->tagihanId,
                'nominal' => $nominal_cleaned,
                'tgl_transaksi' => now(),
                'status' => 'Cicilan',
            ]);

            return response()->json(['message'=>'Transaksi Berhasil']);
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
            Transaksi::create([
                'kode_transaksi' => Str::random(10),
                'saba_id' => $request->sabaId,
                'tagihan_id' => $request->tagihanId,
                'nominal' => $nominal_cleaned,
                'tgl_transaksi' => now(),
                'status' => 'Lunas',
            ]);
            return response()->json(['message'=>'Transaksi Berhasil']);
        }

    }
}
