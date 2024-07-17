<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saba;
use App\Providers\Service\SantriService;
use App\Providers\Service\UserService;

class AdminController extends Controller
{
    protected $santriService;
    protected $userService;
    public function __construct(SantriService $santriService, UserService $userService)
    {
        $this->santriService = $santriService;
        $this->userService = $userService;
    }
    // index dashboard
    public function index()
    {
        $jumlahSantri =$this->santriService->getAll()->count();
        $jumlahAdmin = $this->userService->getUserAdmin()->count();
        $JUMLAH = [
            'jumlahSantri' => $jumlahSantri,
            'jumlahAdmin' => $jumlahAdmin,
        ];
        // dd($jumlahAdmin);
        return view('dashboard.admin.index', compact('JUMLAH'));
    }
}

