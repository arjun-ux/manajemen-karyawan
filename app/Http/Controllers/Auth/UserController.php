<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\Service\UserService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    // user santri
    public function santri(){
        return view('dashboard.admin.user.santri');
    }
    // data user santri
    public function userSantri(){
        $results = $this->userService->getUserSantri();
        return DataTables::of($results)
                ->addColumn('action', function($row){
                    $btn = '<a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                    return $btn;
                })
                ->addIndexColumn()
                ->toJson();
    }
    // get user santri id
    public function get_santri_by_id($id){
        $results = $this->userService->getUserSantriById($id);
        return $results;
    }
    // upadate password user santri
    public function update_password_santri(Request $request, $uid){
        $results = $this->userService->updatePasswordSantri($request,$uid);
        return $results;
    }
    // user admin
    public function admin(){
        return view('dashboard.admin.user.admin');
    }
    // data user admin
    public function userAdmin(){
        $results = $this->userService->getUserAdmin();
        return DataTables::eloquent($results)
                    ->addColumn('action', function($row){
                        $btn = '<a href="#" data-id="'.$row->id.'" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                        $btn .= ' <a href="#" data-id="'.$row->id.'" class="btn_delete btn btn-outline-danger btn-sm mt-1"><i class="lni lni-trash-can"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
    }
    // store admin
    public function store_admin(Request $request){
        $results = $this->userService->storeAdmin($request);
        return $results;
    }
    // get admin by id
    public function getIdAdmin($uid){
        $results = $this->userService->getAdminById($uid);
        return response()->json(['data'=>$results]);
    }
    // update admin
    public function update_admin(Request $request){
        $results = $this->userService->UpdateAdmin($request);
        return $results;
    }
    // delete admin
    public function delete_admin($uid){
        $results = $this->userService->deleteAdmin($uid);
        return $results;
    }
}
