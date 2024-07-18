<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KamarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_kamar'=>'required',
            'pembimbing'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'nama_kamar.required' => 'Kamar Wajib di isi',
            'pembimbing.required' => 'Pembimbing Wajib di isi',
        ];
    }
}
