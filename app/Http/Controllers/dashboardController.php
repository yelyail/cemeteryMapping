<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CusAuthController;
use App\Models\Buyer;
use App\Models\plotInvent;
use App\Models\deceaseInfo;
use App\Models\staff;
use App\Models\maintenanceRecord;
use App\Models\transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
                                    ->first();
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
    public function purchase()
    {
        $plots = $this->purchaseAll();
        return view('project.CIPurchase', compact('plots'));
    }
    public static function purchaseAll()
    {
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
            ->get();
        return $plots;
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
            // Filter data for the current cemetery
            $filteredData = $cemeteryData->where('cemName', $cemeteryName);
            $plotTotals[$cemeteryName] = range(1, $filteredData->max('plotTotal'));
            $plotPrices[$cemeteryName] = $filteredData->first()['plotPrice'];
            $plotAvailables[$cemeteryName] = $filteredData->first()['plotAvailable'];
            $plotMaintenanceFees[$cemeteryName] = $filteredData->first()['plotMaintenanceFee'];
            $sizes[$cemeteryName] = $filteredData->first()['size'];
            $establishmentDates[$cemeteryName] = $filteredData->first()['establishmentDate'];
            $plotInventIDs[$cemeteryName] = $filteredData->first()['plotInventID']; // Add this line
        }
        return view('project.Buy', compact('plotInventIDs', 'cemeteryNames', 'plotTotals', 'plotPrices', 'plotAvailables', 'plotMaintenanceFees', 'sizes', 'establishmentDates'));
    }
    public static function reservePlot(Request $request)
    {
        try {
            $validatedData = $request->validate([
                    'cemName' => 'required|string|max:255',
                    'plotNum' => 'required|integer',
                    'ownerName' => 'required|string|max:255',
                    'contactNumber' => 'required|string|max:20',
                    'email' => 'required|email|max:255',
                    'address' => 'required|string|max:255',
                    'plotPrice' => 'required|numeric',
                    'purchaseDate' => 'required|date',
                    'ttlplot' => 'required|integer',
                    'pltVail' => 'required|integer',
                    'pmFee' => 'required|numeric',
                    'size' => 'required|string|max:255',
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
        return view('project.HistoricalRec');
    }
    public static function storeHisto()
    {
        $histo = deceaseInfo::with('plotInvent')
            ->select('tblplotinvent.plotNum',
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
            ->get();

        return $histo;
    }
    public function addDecease(){
        $cemeteryData = plotInvent::select(
            'cemName',
            'plotTotal',
            'plotAvailable',
            'plotMaintenanceFee',
            'size',
            'status',
            'plotNum', 
            'plotPrice'
            )
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
        return view('project.Ownership');
    }
    public static function ownerInfo(){
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
        return $plots;
    }
    public function addMaintain(){
        $fullNames = Buyer::distinct('fullName')->pluck('fullName');
        $staffNames = staff::distinct('name')->pluck('name');
        $deceaseNames = deceaseInfo::distinct('firstName')->pluck('firstName');
        return view('project.addMaintain', compact('fullNames','staffNames','deceaseNames'));
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
            CusAuthController::showAlert('success', 'Success!', 'Decease added successfully!');
       }catch(\Exception $e)
       {
        CusAuthController::showAlert('error', 'Error!', $e->getMessage());
       }
       return redirect()->back();
    }
    public function maintainRec(){
        return view('project.MaintenanceRec');
    }
    public static function storeMaintainRec(){
        $maintenances = maintenanceRecord::select('tblOwner.fullName',
                    DB::raw("CONCAT(tbldeceaseInfo.firstName, ' ', LEFT(tbldeceaseInfo.middleName, 1), '. ', tbldeceaseInfo.lastName) AS deceaseName"),
                    'tblStaff.name',
                    'tblplotInvent.plotNum',
                    'tblMaintenance.maintenanceName',
                    'tblMaintenance.maintainDescription',
                    'tblMaintenance.amount',
                    'tblMaintenance.renewalPaymentDate')
            ->leftJoin('tbldeceaseInfo', 'tbldeceaseInfo.deceaseID', '=', 'tblMaintenance.deceaseID')
            ->leftJoin('tblStaff', 'tblStaff.staffID', '=', 'tblMaintenance.staffID')
            ->leftJoin('tblplotInvent', 'tblplotInvent.plotInventID', '=', 'tbldeceaseInfo.plotInventID')
            ->leftJoin('tblOwner', 'tblOwner.ownerID', '=', 'tblplotInvent.ownerID')
            ->get();
        return $maintenances;
    }
    public function storeTransferReason(Request $request)
    {
       $request->validate([
        'reason' => 'required|string|max:255',
        'decease_id' => 'required|exists:tbldeceaseinfo,deceaseID',
        ]);
        $deceaseInfo = deceaseInfo::find($request->decease_id);

        if ($deceaseInfo) {
            $deceaseInfo->reason = $request->reason;
            $deceaseInfo->save();
            return redirect()->route('transaction')->with('success', 'Transfer reason stored successfully');
        } else {
            return redirect()->route('transaction')->with('error', 'Error storing transfer reason');
        }
    }
    public function staff(){
        return view('project.staff');
    }
    public static function staffAdd(){
        $staff = staff::select('name', 
                            'role', 
                            'contactNum', 
                            'contactEmail')->get();
        return $staff;
    }
    public function addStaff(){
        return view('project.addStaff');
    }
    public function storeStaff(Request $request){
        try {
            $validatedData = $request->validate([
                'fullName' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'contactNum' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
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
    public function transaction(){
        return view('project.Transaction');
    }
    public static function storeTransact(){
        $transactions = transaction::select(
            'tblTransaction.transactDateTime',
            'tblowner.fullname as owner_fullname',
            DB::raw("CONCAT(tbldeceaseinfo.firstName, ' ', LEFT(tbldeceaseinfo.middleName, 1), '.', ' ', tbldeceaseinfo.lastName) AS decease_name"),
            DB::raw("CONCAT('Cemetery Name: ', tblplotInvent.cemName, ', Plot #', tblplotInvent.plotNum) AS location"),
            'tblmaintenance.updated_at',
            'tbldeceaseinfo.reason'
        )
        ->join('tblmaintenance', 'tblTransaction.maintainRec_ID', '=', 'tblmaintenance.maintainRec_ID')
        ->join('tbldeceaseinfo', 'tblmaintenance.deceaseID', '=', 'tbldeceaseinfo.deceaseID')
        ->join('tblplotInvent', 'tbldeceaseinfo.plotInventID', '=', 'tblplotInvent.plotInventID')
        ->join('tblowner', 'tblplotInvent.ownerID', '=', 'tblowner.ownerID')
        ->get();
        
        return $transactions;
    }
    public function transStore(Request $request) {
        // Validate the request
        $validated = $request->validate([
            'decease_id' => 'required|integer',
            'reason' => 'required|string|max:255',
        ]);

        $transaction = new transaction();
        $transaction->decease_id = $validated['decease_id'];
        $transaction->reason = $validated['reason'];
        $transaction->transactDateTime = now(); 
        $transaction->save();
    
        return redirect()->route('transaction')->with('success', 'Transaction recorded successfully.');
    }
    public function cancelTransact(Request $request){
        $plotInventID = $request->plotInventID;
        $plot = plotInvent::find($plotInventID);
        if ($plot) {
            $plot->status = 'cancel'; 
            $plot->save();
        }
        return redirect()->route('transactCancel');
        // $plots = PlotInvent::where('status', 'cancel')->get();
        // // $plots =Buyer::where("fullname",'plotInventID');

        // return view('project.TransactionCan')->with('plots', $plots);  
    }
    public function transactCancel(){
        $plots = plotInvent::where('status', 'cancel')->get();
        return view('project.TransactionCan')->with('plots', $plots);    
    }
    public function infoTransact(){
        return view('project.TransactionRef');
    }
    
}
