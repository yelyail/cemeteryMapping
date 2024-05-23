<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\deceaseInfo;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function generatePDF()
    {    
        $deceased = deceaseInfo::whereHas('plotInvent', function($query) {
            $query->where('stat', 'transfer'); })
            ->with(['plotInvent.buyer'])
            ->get();
        $reference = uniqid();
        $data=[
            'title' => 'Welcome to G.B.N.F. Mapping Co.',
            'reference' => $reference,
            'date' => date('m/d/Y'),
            'deceased' => $deceased
        ];
        
        $pdf = PDF::loadView('project.generatePDF', $data);
        return $pdf->download('invoice.pdf');
    }
}
