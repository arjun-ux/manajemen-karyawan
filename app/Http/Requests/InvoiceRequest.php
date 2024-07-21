<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nis' => 'sometimes',
            'nama_tagihan' => 'required',
            'nominal_tagihan' => 'required',
            'bulanTahun' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nis.sometimes' => 'Nis Wajib Di isi',
            'nama_tagihan.required' => 'Pilih Tagihan',
            'nominal_tagihan.required' => 'Nominal Jangan Dihapus',
            'bulanTahun.required' => 'Bulan/Tahun Wajib Di isi',
        ];
    }
}
