<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\deceaseInfo;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function generatePDF($deceaseID)
    {    
        $deceased = deceaseInfo::with(['plotInvent.buyer'])->findOrFail($deceaseID);

        $reference = uniqid();
        $data=[
            'title' => 'GoneButNotForgotten',
            'reference' => $reference,
            'date' => date('m/d/Y'),
            'deceased' => $deceased
        ];
        
        $pdf = PDF::loadView('project.generatePDF', $data);
        return $pdf->download('invoice.pdf');
    }
    public function pdfReport()
    {    

        $reference = uniqid();
        $data=[
            'title' => 'GoneButNotForgotten',
            'reference' => $reference,
            'date' => date('m/d/Y')
        ];
        
        $pdf = PDF::loadView('project.generatePDF', $data);
        return $pdf->download('invoice.pdf');
    }
}
