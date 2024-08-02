<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SantriRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            // 'no_wa' => 'required',
            // 'nik' => 'required|min:16|max:16',
            // 'nokk' => 'required|min:16|max:16',
            // 'nama_lengkap' => 'required',
            // 'tempat_lahir' => 'required',
            // 'tanggal_lahir' => 'required',
            // 'provinsi' => 'required',
            // 'kabupaten' => 'required',
            // 'kecamatan' => 'required',
            // 'desa' => 'required',
            // 'nik_ayah' => 'required',
            // 'nama_ayah' => 'required',
            // 'pekerjaan_ayah' => 'required',
            // 'nik_ibu' => 'required',
            // 'nama_ibu' => 'required',
            // 'pekerjaan_ibu' => 'required',
        ];
        $rules['no_wa'] = 'sometimes|required';
        return $rules;
    }
    public function messages()
    {
        return [
            // 'no_wa.required' => 'No WA Wajib Di Isi',
            // 'nik.required' => 'Nik Wajib Di Isi',
            // 'nik.min' => 'Nik Harus 16 Karakter',
            // 'nik.max' => 'Nik Harus 16 Karakter',
            // 'nokk.required' => 'NO KK Wajib Di Isi',
            // 'nokk.min' => 'Nik Harus 16 Karakter',
            // 'nokk.max' => 'Nik Harus 16 Karakter',
            // 'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            // 'tempat_lahir.required' => 'Tempat Lahir Wajib Di Isi',
            // 'tanggal_lahir.required' => 'Tanggal Lahir Wajib Di Isi',
            // 'provinsi.required' => 'Provinsi Wajib Di Isi',
            // 'kabupaten.required' => 'Kabupaten Wajib Di Isi',
            // 'kecamatan.required' => 'Kecamatan Wajib Di Isi',
            // 'desa.required' => 'Desa Wajib Di Isi',
            // 'nik_ayah.required' => 'NIK Ayah Wajib Di Isi',
            // 'nama_ayah.required' => 'Nama Ayah Wajib Di Isi',
            // 'pekerjaan_ayah.required' => 'Pekerjaan Ayah Wajib Di Isi',
            // 'nik_ibu.required' => 'NIK Ibu Wajib Di Isi',
            // 'nama_ibu.required' => 'Nama Ibu Wajib Di Isi',
            // 'pekerjaan_ibu.required' => 'Pekerjaan Ibu Wajib Di Isi',
        ];
    }
}
