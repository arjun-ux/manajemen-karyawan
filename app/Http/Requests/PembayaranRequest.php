<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'jenis_pembayaran'=>'required',
            'jumlah'=>'required',
            'keterangan'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'jenis_pembayaran.required' => 'Jenis Pembayaran Wajib di isi',
            'jumlah.required' => 'Jumlah Wajib di isi',
            'keterangan.required' => 'Keterangan Wajib di isi',
        ];
    }
}
