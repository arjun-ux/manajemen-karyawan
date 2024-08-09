<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // user admin
    public function index(){
        return view('pages.user.index');
    }
    // data user admin
    public function data(){
        $data = User::query();
        return DataTables::eloquent($data)
                    ->addColumn('action', function($row){
                        if ($row->role == 'superadmin') {
                            $btn = '<a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                            return $btn;
                        }
                        $btn = '<a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                        $btn .= ' <a href="#" data-id="'.$row->id.'" class="btn_delete btn btn-outline-danger btn-sm mt-1"><i class="lni lni-trash-can"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
    }

    // store admin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ],[
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib diisi'
        ]);

        $users = DB::table('users')
            ->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        if ($users) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan',
                'title' => 'Berhasil'
            ]);
        }
    }
    // get admin by id
    public function userId($id){
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }
    // update user
    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'password' => 'required',
            'role' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return response()->json(['message'=>'Data Berhasil Di Update']);
    }

    // delete
    public function delete(Request $request)
    {
        $data = User::where('id', $request->id)->delete();
        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
