<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\Service\InvoiceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    protected $Invoice;
    public function __construct(InvoiceService $Invoice)
    {
        return $this->Invoice = $Invoice;
    }
    // index invoice
    public function indexInvoice(){
        return view('dashboard.admin.invoice.tagihan');
    }
    // datatable invoice
    public function allInvoice(){
        $results = $this->Invoice->all_invoice();
        return DataTables::eloquent($results)
                ->addColumn('nis', function($row){
                    return $row->saba->nis;
                })
                ->addColumn('nama_lengkap', function($row){
                    return $row->saba->nama_lengkap;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="#" data-id="'.$row->id.'" class="btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>';
                    return $btn;
                })
                ->addIndexColumn()
                ->toJson();
    }
}
