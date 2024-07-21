<?php

namespace App\Providers\Service;

use App\Models\Invoice;
use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use PhpParser\Node\Stmt\Return_;

class InvoiceService extends ServiceProvider
{
    // all Invoice
    public static function all_invoice(){
        $datas = Invoice::query();
        return $datas;
    }
}
