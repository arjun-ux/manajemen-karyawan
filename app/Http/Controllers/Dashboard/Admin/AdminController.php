<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saba;
use App\Providers\Service\SantriService;
use App\Providers\Service\TransaksiService;
use App\Providers\Service\UserService;

class AdminController extends Controller
{
    protected $santriService;
    protected $userService;
    protected $transaksiService;
    public function __construct(SantriService $santriService, UserService $userService, TransaksiService $transaksiService)
    {
        $this->santriService = $santriService;
        $this->userService = $userService;
        $this->transaksiService = $transaksiService;
    }
    // index dashboard
    public function index()
    {
        $jumlahSantri =$this->santriService->getAll()->count();
        $jumlahAdmin = $this->userService->getUserAdmin()->count();
        $jumlahTransaksi = $this->transaksiService->getAll()->count();
        $JUMLAH = [
            'jumlahSantri' => $jumlahSantri,
            'jumlahAdmin' => $jumlahAdmin,
            'transaksi' => $jumlahTransaksi,
        ];
        // dd($jumlahAdmin);
        return view('dashboard.admin.index', compact('JUMLAH'));
    }
}

