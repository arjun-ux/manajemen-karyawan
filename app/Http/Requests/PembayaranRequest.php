<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_pembayaran'=>'required',
            'nominal_pembayaran'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'nama_pembayaran.required' => 'Nama Pembayaran Wajib di isi',
            'nominal_pembayaran.required' => 'Nominal Wajib di isi',
        ];
    }
}
