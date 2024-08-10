<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    // index
    public function index()
    {
        return view('pages.karyawan.index');
    }
    // data table
    public function data(Request $request)
    {
        $role = Auth::user()->role;
        if ($request->ajax()) {
            $data = Karyawan::query();
            return DataTables::eloquent($data)
            ->addColumn('action', function($row) use ($role){
                if ($role == 'admin') {
                    $btn = ' <a href="#" id="detail" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm mt-1"><i class="lni lni-empty-file"></i></a>';
                    return $btn;
                }
                $btn = '<a id="enable" href="' . route('karyawan.edit', $row->id) . '" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                $btn .= ' <a href="#" id="detail" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm mt-1"><i class="lni lni-empty-file"></i></a>';
                $btn .= ' <a href="#" id="hapus" data-id="' . $row->id . '" class="btn-nonAktif btn btn-outline-danger btn-sm mt-1"><i class="lni lni-trash-can"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
        }
    }
    // page create
    public function create()
    {
        return view('pages.karyawan.add');
    }
    // store data
    public function store(Request $request)
    {
        $replace_name = str_replace(' ','', $request->nama_lengkap);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = 'fotos/'.$replace_name.'.'. $file->getClientOriginalExtension();
            $foto = $file->store($path, 'public');
        }else{
            $foto = null;
        }
        // $request->validate();
        $karyawan = DB::table('karyawans')
            ->insert([
                'no_ktp' => $request->no_ktp,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat_tempat_tinggal' => $request->alamat_tempat_tinggal,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telepon' => $request->no_telepon,
                'agama' => $request->agama,
                'no_bpjs_ketenaga_kerja' => $request->no_bpjs_ketenaga_kerja,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status_pernikahan' => $request->status_pernikahan,
                'jenjang_pendidikan' => $request->jenjang_pendidikan,
                'jabatan_kerja' => $request->jabatan_kerja,
                'gaji' => $request->gaji,
                'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
                'status_kerja' =>  $request->status_kerja,
                'status_aktif' => 'aktif',
                'foto' => $foto,
                'email' => $request->email
            ]);


        if ($karyawan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan',
                'title' => 'Berhasil'
            ]);
        }
    }
    // detail data
    public function detail($id){
        $karyawan = DB::table('karyawans')->select('karyawans.*')->where('id', $id)->first();
        return response()->json($karyawan);
    }
    // edit
    public function edit($id)
    {
        $karyawan = DB::table('karyawans')->select('karyawans.*')->where('id', $id)->first();
        // dd($karyawan);
        return view('pages.karyawan.edit', [
            'karyawan' => $karyawan
        ]);
    }
    // update
    public function update(Request $request)
    {
        $berkasAda = Karyawan::where('id', $request->id)->first();
        if ($berkasAda) {
            $path_foto = $berkasAda->foto;
        }
        $foto= $path_foto;
        if ($request->hasFile('foto')) {
            if ($path_foto) {
                Storage::delete('public/' . $path_foto);
                $file = $request->file('foto');
                $foto = $file->store($path_foto, 'public');
            }
        }else{
            $foto = $path_foto;
        }
        $karyawan = DB::table('karyawans')
            ->where('id', $request->id)
            ->update([
                'no_ktp' => $request->no_ktp,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat_tempat_tinggal' => $request->alamat_tempat_tinggal,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telepon' => $request->no_telepon,
                'no_bpjs_ketenaga_kerja' => $request->no_bpjs_ketenaga_kerja,
                'agama' => $request->agama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status_pernikahan' => $request->status_pernikahan,
                'jenjang_pendidikan' => $request->jenjang_pendidikan,
                'jabatan_kerja' => $request->jabatan_kerja,
                'gaji' => $request->gaji,
                'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
                'status_kerja' =>  $request->status_kerja,
                'status_aktif' => 'aktif',
                'foto' => $foto,
                'email' => $request->email
            ]);

        if ($karyawan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
                'title' => 'Berhasil'
            ]);
        }
    }
    // delete
    public function hapus(Request $request)
    {
        $data = DB::table('karyawans')->where('id', $request->id)->delete();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
