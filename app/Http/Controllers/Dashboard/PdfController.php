<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\Service\PdfService;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $pdfService;
    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }
    // donwload bukti pendaftaran
    public function buktiPendaftaran($id){
        $result = $this->pdfService->PdfPendaftaran($id);
        return $result;
    }
}
