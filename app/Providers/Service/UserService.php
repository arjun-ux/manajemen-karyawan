<?php

namespace App\Providers\Service;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class UserService extends ServiceProvider
{
    // get all user santri
    public static function getUserSantri(){
        $datas = DB::table('users as user')
                    ->join('sabas as saba', 'saba.user_id', '=', 'user.id')
                    ->where('user.role', 'saba')
                    ->get(['user.*', 'saba.nama_lengkap']);
        return $datas;
    }
    // user santri
    public static function getUserAdmin(){
        $datas = User::where('role', 'admin')->get();
        return $datas;
    }
}
