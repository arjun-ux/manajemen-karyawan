<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\Service\UserService;
use Yajra\DataTables\Facades\DataTables;
use App\Providers\RouteParamService as routeParam;

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
                    $btn = '<a href="#" class="btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
    }
    // user admin
    public function admin(){
        return view('dashboard.admin.user.admin');
    }
}
