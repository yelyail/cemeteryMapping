<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\deceaseInfo;
use App\Models\plotInvent;
use Illuminate\Support\Facades\DB;
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
        $cemInfo = plotInvent::select(
            'cemName', 
            'size', 
            'plotTotal', 
            'plotPrice', 
            'plotMaintenanceFee', 
            'establishmentDate'
        )->whereNull('ownerID')->get();
        $buyer = Buyer::select(
            'fullName',
            'contactNum',
            'email',
            'address')->get();
        $decease = deceaseInfo::with('plotInvent')
            ->select('tblplotinvent.plotInventID',
                DB::raw("CONCAT(tbldeceaseinfo.firstName, ' ', tbldeceaseinfo.middleName, ' ', tbldeceaseinfo.lastName) as fullName"),
                'tbldeceaseinfo.gender',
                'tbldeceaseinfo.bornDate',
                'tbldeceaseinfo.diedDate',
                'tbldeceaseinfo.burialDate',
                'tbldeceaseinfo.deceaseID'
            )->join('tblplotinvent', 'tbldeceaseinfo.plotInventID', '=', 'tblplotinvent.plotInventID')->get();

        $data=[ 
            'title' => 'CEMETERY REPORTS',
            'reference' => $reference,
            'date' => date('m/d/Y'),
            'cemInfo' => $cemInfo,
            'buyerInfo' => $buyer,
            'deceaseInfo' => $decease
        ];
        
        $pdf = PDF::loadView('project.reports', $data);
        return $pdf->download('reports.pdf');
    }
}
