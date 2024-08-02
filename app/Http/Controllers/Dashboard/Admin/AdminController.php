<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\KamarController;
use Illuminate\Http\Request;
use App\Models\Saba;
use App\Providers\Service\SantriService;
use App\Providers\Service\SettingsService;
use App\Providers\Service\TransaksiService;
use App\Providers\Service\UserService;

class AdminController extends Controller
{
    protected $santriService;
    protected $userService;
    protected $transaksiService;
    protected $settingsService;
    public function __construct(SantriService $santriService, UserService $userService, TransaksiService $transaksiService, SettingsService $settingsService)
    {
        $this->santriService = $santriService;
        $this->userService = $userService;
        $this->transaksiService = $transaksiService;
        $this->settingsService = $settingsService;
    }
    // index dashboard
    public function index()
    {
        $jumlahSantri =$this->santriService->getAll()->count();
        $jumlahAdmin = $this->userService->getUserAdmin()->count();
        $jumlahTransaksi = $this->transaksiService->getAll()->count();
        $kamar = $this->settingsService->penghuniKamar();
        $JUMLAH = [
            'jumlahSantri' => $jumlahSantri,
            'jumlahAdmin' => $jumlahAdmin,
            'transaksi' => $jumlahTransaksi,
            'kamar' => $kamar
        ];
        // dd($kamar);
        return view('dashboard.admin.index', compact('JUMLAH'));
    }
}

