<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CusAuthController;
use App\Models\Buyer;
use App\Models\plotInvent;
use App\Models\deceaseInfo;
use App\Models\staff;
use App\Models\maintenanceRecord;
use App\Models\transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class dashboardController extends Controller
{   
    public function cemInfo(){ 
        $cemInfo = plotInvent::select('cemName', 
                                    'size', 
                                    'plotTotal', 
                                    'plotPrice', 
                                    'plotMaintenanceFee', 
                                    'establishmentDate',
                                    'plotAvailable')
                                    ->whereNull('ownerID')
                                    ->orderBy('plotAvailable', 'desc')
                                    ->get();
        return view('project.Cemeteryinfo', ['cemInfo' => $cemInfo]);
    }
    public function cemAdd(){ 
        return view('project.ADD');
    }
    public function storeCemAdd(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cemName' => 'required|string|unique:tblplotinvent,cemName',
                'ttlplots' => 'required|integer',
                'pltAvail' => 'required|integer',
                'plotPrice' => 'required|numeric',
                'pmFee' => 'required|numeric',
                'establishmentDate' => 'required|date', 
            ]);
            $existingCemetery = plotInvent::where('cemName', $validatedData['cemName'])->first();
            if ($existingCemetery) {
                throw new \Exception('The cemetery with the same name already exists.');
            }
            $plotInvent = new plotInvent();
            $plotInvent->cemName = $validatedData['cemName'];
            $plotInvent->size = '100x150'; 
            $plotInvent->plotTotal = $validatedData['ttlplots'];
            $plotInvent->plotPrice = $validatedData['plotPrice'];
            $plotInvent->plotMaintenanceFee = $validatedData['pmFee'];
            $plotInvent->establishmentDate = $validatedData['establishmentDate'];
            $plotInvent->plotAvailable= $validatedData['pltAvail'];
            $plotInvent->save(); 
            
            CusAuthController::showAlert('success', 'Success!', 'Cemetery Added successfully!');
        } catch (\Exception $e) {
            CusAuthController::showAlert('error', 'Error!', $e->getMessage());
        }
        return redirect()->back();
    }
    public function purchase(){ 
        $plots = plotInvent::with('Buyer')
                ->select('tblplotinvent.plotInventID',
                        'tblplotinvent.cemName',
                        'tblowner.fullName', 
                        'tblplotinvent.plotNum',
                        'tblplotinvent.size',
                        'tblplotinvent.plotPrice',
                        'tblplotinvent.purchaseDate')
                ->join('tblowner', 'tblplotinvent.ownerID', '=', 'tblowner.ownerID')
                ->whereNotNull('tblplotinvent.cemName')
                ->whereNotNull('tblowner.fullName')
                ->whereNull('stat')
                ->get();
        return view('project.CIPurchase', ['plots' => $plots]);
    }
    public static function buyPlot()
    {  
        $cemeteryData = plotInvent::select(
            'plotInventID',
            'cemName',
            'plotTotal',
            'plotAvailable',
            'plotMaintenanceFee',
            'size',
            'plotNum',
            'plotPrice',
            'establishmentDate'
        )->get();
        
        $cemeteryNames = $cemeteryData->pluck('cemName')->unique();
        
        $plotTotals = [];
        $plotPrices = [];
        $plotAvailables = [];
        $plotMaintenanceFees = [];
        $sizes = [];
        $establishmentDates = []; 

        foreach ($cemeteryNames as $cemeteryName) {
            $filteredData = $cemeteryData->where('cemName', $cemeteryName);
            $plotTotals[$cemeteryName] = range(1, $filteredData->max('plotTotal'));
            $plotPrices[$cemeteryName] = $filteredData->first()['plotPrice'];
            $plotAvailables[$cemeteryName] = $filteredData->first()['plotAvailable'];
            $plotMaintenanceFees[$cemeteryName] = $filteredData->first()['plotMaintenanceFee'];
            $sizes[$cemeteryName] = $filteredData->first()['size'];
            $establishmentDates[$cemeteryName] = $filteredData->first()['establishmentDate'];
            $plotInventIDs[$cemeteryName] = $filteredData->first()['plotInventID']; 
        }
        return view('project.Buy', compact('plotInventIDs', 'cemeteryNames', 'plotTotals', 'plotPrices', 'plotAvailables', 'plotMaintenanceFees', 'sizes', 'establishmentDates'));
    }
    public static function reservePlot(Request $request)
    {
        try {
            $validatedData = $request->validate([
                    'cemName' => 'required|string|max:50',
                    'plotNum' => 'required|integer',
                    'ownerName' => 'required|string|max:100',
                    'contactNumber' => 'required|string|max:11',
                    'email' => 'required|email|max:50',
                    'address' => 'required|string|max:100',
                    'plotPrice' => 'required|numeric',
                    'purchaseDate' => 'required|date',
                    'ttlplot' => 'required|integer',
                    'pltVail' => 'required|integer',
                    'pmFee' => 'required|numeric',
                    'size' => 'required|string|max:10',
                    'establishMent' => 'required|date',
            ]);
            // $latestPlotAvailable = PlotInvent::where('cemName', $validatedData['cemName'])
            // ->where('plotNum', $validatedData['plotNum'])
            // ->value('plotAvailable');

            // if ($latestPlotAvailable) {
            //     $latestPlotAvailable->decrement('plotAvailable', 1);
            //     $latestPlotAvailable->save();
            //     $plotAvailable = $latestPlotAvailable->plotAvailable;   
            // } else {
            //     $plotAvailable = $latestPlotAvailable;
            // }
            $existingPlot = plotInvent::where('cemName', $validatedData['cemName'])->where('plotNum', $validatedData['plotNum'])->first();
            if ($existingPlot) {
                throw new \Exception('The selected plot number has already been reserved in the specified cemetery.');
            }
            $buyer = Buyer::create([
                'fullName' => $validatedData['ownerName'],
                'contactNum' => $validatedData['contactNumber'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
            ]);
            $plotAvailable = $request->filled('pltAvail') ? $request->input('pltAvail') : $validatedData['ttlplot'];

            $plotNew = plotInvent::updateOrCreate(
                ['cemName' => $validatedData['cemName'], 'plotNum' => $validatedData['plotNum']],
                [
                    'ownerID' => $buyer->ownerID,
                    'plotPrice' => $validatedData['plotPrice'],
                    'purchaseDate' => $validatedData['purchaseDate'],
                    'plotTotal' => $validatedData['ttlplot'],
                    'plotMaintenanceFee' => $validatedData['pmFee'],
                    'plotAvailable' => $plotAvailable,
                    'size' => $validatedData['size'],
                    'establishmentDate' => $validatedData['establishMent'],
                ]);
            if ($plotNew) {
                $plotNew->plotAvailable--;
                $plotNew->save();
                CusAuthController::showAlert('success', 'Success!', 'Plot reserved successfully!');
                return redirect()->route('purchase', ['cemName' => $validatedData['cemName']]);
            } else {
                throw new \Exception('Failed to reserve plot.');
            }
        } catch (\Exception $e) {
                CusAuthController::showAlert('error', 'Error', $e->getMessage());
                return redirect()->back();
            }
    }
    public function histoRec(){
        $histo = deceaseInfo::with('plotInvent')
                ->select('tblplotinvent.plotInventID',
                    'tbldeceaseinfo.firstName',
                    'tbldeceaseinfo.middleName',
                    'tbldeceaseinfo.lastName',
                    'tbldeceaseinfo.gender',
                    'tbldeceaseinfo.bornDate',
                    'tbldeceaseinfo.diedDate',
                    'tbldeceaseinfo.burialDate',
                    'tbldeceaseinfo.deceaseID'
                )
                ->join('tblplotinvent', 'tbldeceaseinfo.plotInventID', '=', 'tblplotinvent.plotInventID')
                ->whereNull('tbldeceaseinfo.statusDec')
                ->get();
        return view('project.HistoricalRec', ['histo' => $histo]);
    }
    public function addDecease(){
        $cemeteryData = plotInvent::select(
            'cemName',
            'plotTotal',
            'plotAvailable',
            'plotMaintenanceFee',
            'size',
            'stat',
            'plotNum', 
            'plotPrice')
            ->get();
        $cemeteryNames = plotInvent::distinct('cemName')->pluck('cemName');
        $plotTotals = [];
        $plotPrices = [];
        foreach ($cemeteryNames as $cemeteryName) {
            $maxPlotTotal = plotInvent::where('cemName', $cemeteryName)->max('plotTotal');
            $plotTotals[$cemeteryName] = range(1, $maxPlotTotal);
            $plotPrice = plotInvent::where('cemName', $cemeteryName)->value('plotPrice');
            $plotPrices[$cemeteryName] = $plotPrice;
        }
        return view('project.addDecease', compact('cemeteryData', 'cemeteryNames', 'plotTotals', 'plotPrices'));
    }
    public function storeDecease(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cemName' => 'required',
                'plotNum' => 'required',
                'firstName' => 'required',
                'middleName' => 'nullable',
                'lastName' => 'required',
                'gender' => 'required',
                'bornDate' => 'required|date',
                'diedDate' => 'required|date',
                'burialDate' => 'required|date',
            ]);
            $plotInventory = PlotInvent::where('cemName', $validatedData['cemName'])
                    ->where('plotNum', $validatedData['plotNum'])
                    ->first();
            if (!$plotInventory) {
                CusAuthController::showAlert('warning', 'Not Found', 'Grave Location has not Found!');
                return redirect()->back();
            }
            $decease = new deceaseInfo();
            $decease->fill($validatedData);
            $decease->plotInventID = $plotInventory->plotInventID; 
            $decease->save();
            CusAuthController::showAlert('success', 'Success!', 'Decease added successfully!');

        } catch (\Exception $e) {
            CusAuthController::showAlert('error', 'Error!', $e->getMessage());
        }
        return redirect()->back();
    }
    public function owner(){
        $plots = plotInvent::with('Buyer')
                ->select(
                    'tblowner.fullName',
                    'tblowner.contactNum',
                    'tblowner.email',
                    'tblowner.address',
                    'tblplotinvent.cemName',
                    'tblplotinvent.plotNum',
                )
                ->join('tblowner', 'tblplotinvent.ownerID', '=', 'tblowner.ownerID')
                ->get();
    
        return view('project.Ownership', ['plots' => $plots]);
    }
    public function addMaintain()
    {
        $fullNames = Buyer::distinct('fullName')->pluck('fullName');
        $staffNames = Staff::distinct('name')->pluck('name');
        $deceaseNames = DeceaseInfo::distinct('firstName')->pluck('firstName');

        $plotNumbers = DB::table('tblplotinvent')
            ->join('tblowner', 'tblplotinvent.ownerID', '=', 'tblowner.ownerID')
            ->join('tbldeceaseinfo', 'tblplotinvent.plotInventID', '=', 'tbldeceaseinfo.plotInventID')  // Corrected the join clause
            ->select('tblowner.fullName', 'tbldeceaseinfo.firstName', 'tblplotinvent.plotNum')
            ->whereIn('tblowner.fullName', $fullNames)
            ->whereIn('tbldeceaseinfo.firstName', $deceaseNames)
            ->get();

        return view('project.addMaintain', compact('fullNames', 'staffNames', 'deceaseNames', 'plotNumbers'));
    }
  
    public function storeMaintenance(Request $request){
       try{
            $validatedData = $request->validate([
                'ownerName' => 'required|string',
                'deceaseName' => 'required|string',
                'staffName' => 'required|string',
                'plotNum' => 'required|string',
                'maintainName' => 'required|string',
                'maintainDesc' => 'required|string',
                'amount' => 'required|numeric',
                'renewalPaymentDate' => 'required|date',
            ]);
            $owner = Buyer::firstOrCreate(['fullName' => $validatedData['ownerName']]);
            $decease = deceaseInfo::updateOrCreate(['firstName' => $validatedData['deceaseName']]);
             $staff = staff::updateOrCreate(['name' => $validatedData['staffName']]);

            $plot = plotInvent::updateOrCreate(['plotNum' => $validatedData['plotNum']], [
                'ownerID' => $owner->ownerID,
            ]);
            maintenanceRecord::create([
                'staffID' => $staff->staffID,
                'deceaseID' => $decease->deceaseID,
                'plotNum' => $plot->plotNum,
                'maintenanceName' => $validatedData['maintainName'],
                'maintainDescription' => $validatedData['maintainDesc'],
                'amount' => $validatedData['amount'],
                'renewalPaymentDate' => $validatedData['renewalPaymentDate'],
            ]);
            CusAuthController::showAlert('success', 'Success!', 'Added/Updated successfully');
       }catch(\Exception $e)
       {
        CusAuthController::showAlert('error', 'Error!', $e->getMessage());
       }
       return redirect()->back();
    }
    public function maintainRec(){
        $maintenances = maintenanceRecord::select('tblOwner.fullName',
                        DB::raw("CONCAT(tbldeceaseInfo.firstName, ' ', LEFT(tbldeceaseInfo.middleName, 1), '. ', tbldeceaseInfo.lastName) AS deceaseName"),
                        'tblStaff.name',
                        'tblplotInvent.plotNum',
                        'tblMaintenance.maintenanceName',
                        'tblMaintenance.maintainDescription',
                        'tblMaintenance.amount',
                        'tblMaintenance.renewalPaymentDate')
                ->join('tbldeceaseInfo', 'tbldeceaseInfo.deceaseID', '=', 'tblMaintenance.deceaseID')
                ->join('tblStaff', 'tblStaff.staffID', '=', 'tblMaintenance.staffID')
                ->join('tblplotInvent', 'tblplotInvent.plotInventID', '=', 'tbldeceaseInfo.plotInventID')
                ->join('tblOwner', 'tblOwner.ownerID', '=', 'tblplotInvent.ownerID')
                ->get();
    
        return view('project.MaintenanceRec', ['maintenances' => $maintenances]);
    }
    public function staff(){
        $staffInfo = staff::select('name', 'role', 'contactNum', 'contactEmail')->get();
        return view('project.staff', ['staffInfo' => $staffInfo]);
    }
    public function addStaff(){
        return view('project.addStaff');
    }
    public function storeStaff(Request $request){
        try {
            $validatedData = $request->validate([
                'fullName' => 'required|string|max:100',
                'role' => 'required|string|max:50',
                'contactNum' => 'required|string|max:11',
                'email' => 'required|string|email|max:50',
            ]);
            if (staff::where('contactEmail', $validatedData['email'])->exists()) {
                throw new \Exception('Email already exists.');
            }
    
            $staffNew = new staff([
                'name' => $validatedData['fullName'],
                'role' => $validatedData['role'],
                'contactNum' => $validatedData['contactNum'],
                'contactEmail' => $validatedData['email'],
            ]);
                $staffNew->save();
            CusAuthController::showAlert('success', 'Success!', 'Staff added successfully!');
        } catch(\Exception $e) {
            CusAuthController::showAlert('error', 'Error!', $e->getMessage());
        }
    
        return redirect()->back();
    }
    public function storeTransferReason(Request $request)
    {
        $validated = $request->validate([
            'decease_id' => 'required|exists:tbldeceaseinfo,deceaseID',
            'reason' => 'required|string|max:255',
        ]);
        $deceaseID = $validated['decease_id'];
        $reason = $validated['reason'];
        $decease = deceaseInfo::find($deceaseID);
        if ($decease) {
            $remarks = $reason === 'Unable to pay the payment for 5 years.' 
                ? 'TRANSFER TO A BIG CROSS' 
                : 'Transfer to Different Cemetery';
        
            $decease->statusDec = 'transfer';
            $decease->remarks = $remarks;
            $decease ->reason = $reason;
            $decease->save();
        }else{
            return redirect()->route('transaction')->with('error', 'Error storing transfer reason');
        }
        return redirect()->route('transaction')->with('success', 'Transaction recorded successfully.');
    }
    public function transaction()
    {
        $decease = deceaseInfo::where('statusDec', 'transfer')
            ->with(['plotInvent'])
            ->get();
        return view('project.Transaction')->with('decease', $decease);
    }
    public function cancelTransact(Request $request){
        $request->validate([
            'plotInventID' => 'required|exists:tblplotinvent,plotInventID'
        ]);
        $plotInventID = $request->input('plotInventID');
        $plot = plotInvent::find($plotInventID);
        if ($plot) {
            $plot->stat = 'cancel';
            $plot->save();
        }
        return redirect()->route('transactCancel'); 
    }
    public function transactCancel()
    {
        $plots = plotInvent::where('stat', 'cancel')
            ->with(['buyer', 'decease'])
            ->get();
        return view('project.TransactionCan')->with('plots', $plots);
    }
    public function infoTransact(){
        return view('project.TransactionRef');
    }
    
}
