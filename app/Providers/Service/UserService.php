<?php

namespace App\Providers\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class UserService extends ServiceProvider
{
    // get all user santri
    public static function getUserSantri(){
        $datas = DB::table('users as user')
                    ->leftJoin('sabas as saba', 'saba.user_id', '=', 'user.id')
                    ->where('user.role', 'saba')
                    ->get(['user.*', 'saba.nama_lengkap']);
        return $datas;
    }
    // get user santri by id
    public static function getUserSantriById($id){
        $data = DB::table('users as user')
                    ->join('sabas as saba', 'saba.user_id', '=', 'user.id')
                    ->where('user.id', $id)
                    ->first(['user.*', 'saba.nama_lengkap']);
        if ($data == null) {
            return 'Data Tidak Di Temukan';
        }else {
            return $data;
        }
    }
    // update user santri
    public static function updatePasswordSantri(Request $request, $uid){
        $request->validate([
            'password' => 'required',
        ],[
            'password.required' => 'Password Wajib Di Isi',
        ]);
        $user = User::where('id', $uid)->first();
        $user->update(['password'=>$request->password]);
        return response()->json(['message'=>'Berhasil Merubah Password']);
    }

    // user admin
    public static function getUserAdmin(){
        $datas = DB::table('users')->where('id', '!=', 1)->get(['id', 'username', 'name', 'no_wa']);
        return $datas;
    }
    // store admin
    public static function storeAdmin(Request $request){
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'no_wa' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username Wajib Di Isi',
            'name.required' => 'Nama Wajib Di Isi',
            'no_wa.required' => 'No WA Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
        ]);
        $message = 'Pendaftaran Anda Sudah Berhasil, Berikut Username Anda: '.$request->username.'.';
        WhatsAppService::sendNotif($request->no_wa, $message);
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'no_wa' => $request->no_wa,
            'password' => $request->password,
            'role' => 'admin'
        ]);
        return response()->json(['message'=>'Data Berhasil Di Buat']);
    }
    // get admin by id
    public static function getAdminById($uid){
        $data = User::where('id', $uid)->first();
        return $data;
    }
    // update admin
    public static function UpdateAdmin(Request $request){
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'no_wa' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username Wajib Di Isi',
            'name.required' => 'Nama Wajib Di Isi',
            'no_wa.required' => 'No WA Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
        ]);
        $data = User::where('id', $request->id)->first();
        $data->update([
            'username' => $request->username,
            'name' => $request->name,
            'no_wa' => $request->no_wa,
            'password' => $request->password,
        ]);
        return response()->json(['message'=>'Berhasil Update Data']);
    }
    // delete admin
    public static function deleteAdmin($uid){
        $data = User::where('id', $uid)->first();
        $data->delete();
        return response()->json(['message'=>'Data Berhasil Di Hapus']);
    }
}
