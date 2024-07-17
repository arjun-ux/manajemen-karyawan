<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\Service\SettingsService;
use Yajra\DataTables\Facades\DataTables;

class KamarController extends Controller
{
    protected $Settings;
    public function __construct(SettingsService $Settings)
    {
        $this->Settings = $Settings;
    }
    // index kamar
    public function index(){
        return view('dashboard.admin.kamar.index');
    }
    // get data dengan ajax
    public function getKamar(){
        $results = $this->Settings->get_all_kamar();
        dd($results);
        return DataTables::eloquent($results)
                ->addIndexColumn()
                ->toJson();
    }
}
