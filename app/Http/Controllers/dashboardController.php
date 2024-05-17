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
        return view('project.Cemeteryinfo');
    }
    public static function storeCemInfo()
    {
        $cemInfo = PlotInvent::select(
            'cemName', 
            'size', 
            'plotTotal', 
            'plotPrice', 
            'plotMaintenanceFee', 
            'establishmentDate',
            'plotAvailable'
        )->orderBy('plotAvailable', 'desc')->first();
        return $cemInfo;
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
            $plotInvent = new PlotInvent();
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
        return view('project.CIPurchase');
    }
    public static function purchaseAll()
    {
        $plots = PlotInvent::with('buyer')
            ->select('tblplotinvent.plotinventID',
                    'tblplotinvent.cemName',
                    'tblowner.fullName', 
                    'tblplotinvent.plotNum',
                    'tblplotinvent.size',
                    'tblplotinvent.plotPrice',
                    'tblplotinvent.purchaseDate')
            ->leftJoin('tblowner', 'tblplotinvent.ownerID', '=', 'tblowner.ownerID')
            ->whereNotNull('tblplotinvent.cemName')
            ->whereNotNull('tblowner.fullName')
            ->get();
        return $plots;
    }
    public static function buyPlot()
    {  
        $cemeteryData = plotInvent::select(
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
            $plotTotals[$cemeteryName] = range(1, $cemeteryData->where('cemName', $cemeteryName)->max('plotTotal'));
            $plotPrices[$cemeteryName] = $cemeteryData->where('cemName', $cemeteryName)->pluck('plotPrice')->first();
            $plotAvailables[$cemeteryName] = $cemeteryData->where('cemName', $cemeteryName)->pluck('plotAvailable')->first();
            $plotMaintenanceFees[$cemeteryName] = $cemeteryData->where('cemName', $cemeteryName)->pluck('plotMaintenanceFee')->first();
            $sizes[$cemeteryName] = $cemeteryData->where('cemName', $cemeteryName)->pluck('size')->first();
            $establishmentDates[$cemeteryName] = $cemeteryData->where('cemName', $cemeteryName)->pluck('establishmentDate')->first();
        }
        return view('project.Buy', compact('cemeteryNames', 'plotTotals', 'plotPrices','plotAvailables','plotMaintenanceFees','sizes','establishmentDates'));
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
            ->leftJoin('tblplotinvent', 'tbldeceaseinfo.plotInventID', '=', 'tblplotinvent.plotInventID')
            ->get();

        return $histo;
    }
    public function addDecease(){
        $cemeteryData = PlotInvent::select(
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
        $cemeteryNames = PlotInvent::distinct('cemName')->pluck('cemName');
        $plotTotals = [];
        $plotPrices = [];
        foreach ($cemeteryNames as $cemeteryName) {
            $maxPlotTotal = PlotInvent::where('cemName', $cemeteryName)->max('plotTotal');
            $plotTotals[$cemeteryName] = range(1, $maxPlotTotal);
            $plotPrice = PlotInvent::where('cemName', $cemeteryName)->value('plotPrice');
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
            $decease = new DeceaseInfo();
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
        $plots = PlotInvent::with('buyer')
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
        $staffNames = Staff::distinct('name')->pluck('name');
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
            $decease = DeceaseInfo::updateOrCreate(['firstName' => $validatedData['deceaseName']]);
             $staff = Staff::updateOrCreate(['name' => $validatedData['staffName']]);

            $plot = PlotInvent::updateOrCreate(['plotNum' => $validatedData['plotNum']], [
                'ownerID' => $owner->ownerID,
            ]);
            MaintenanceRecord::create([
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
                    DB::raw("CONCAT(tblDeceaseInfo.firstName, ' ', LEFT(tblDeceaseInfo.middleName, 1), '. ', tblDeceaseInfo.lastName) AS deceaseName"),
                    'tblStaff.name',
                    'tblPlotInvent.plotNum',
                    'tblMaintenance.maintenanceName',
                    'tblMaintenance.maintainDescription',
                    'tblMaintenance.amount',
                    'tblMaintenance.renewalPaymentDate')
            ->leftJoin('tblDeceaseInfo', 'tblDeceaseInfo.deceaseID', '=', 'tblMaintenance.deceaseID')
            ->leftJoin('tblStaff', 'tblStaff.staffID', '=', 'tblMaintenance.staffID')
            ->leftJoin('tblPlotInvent', 'tblPlotInvent.plotInventID', '=', 'tblDeceaseInfo.plotInventID')
            ->leftJoin('tblOwner', 'tblOwner.ownerID', '=', 'tblPlotInvent.ownerID')
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
        $staff = Staff::select('name', 
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
        $transactions = Transaction::select(
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

        $transaction = new Transaction();
        $transaction->decease_id = $validated['decease_id'];
        $transaction->reason = $validated['reason'];
        $transaction->transactDateTime = now(); // Assuming you want to store the current datetime
        $transaction->save();
    
        return redirect()->route('transaction')->with('success', 'Transaction recorded successfully.');
    }
    public function cancelTransact(){
        return view('project.TransactionCan');
    }
    public static function storeCancel()
    {
        $plots = PlotInvent::with('Buyer')
            ->select(
                'tblplotinvent.cemName',
                'tblowner.fullName', 
                'tblplotinvent.plotNum',
                'tblplotinvent.plotPrice',
                'tblplotinvent.purchaseDate',
                'tblplotinvent.ownerID',
                'tblplotinvent.plotInventID'
            ) 
            ->leftJoin('tblowner', 'tblplotinvent.ownerID', '=', 'tblowner.ownerID')
            ->whereNotNull('tblplotinvent.cemName')
            ->whereNotNull('tblowner.fullName')
            ->get();
        // dd($plots);
        $cancelTrans = Transaction::select(
                'tblowner.fullName as owner_fullname',
                DB::raw("CONCAT(tbldeceaseinfo.firstName, ' ', LEFT(tbldeceaseinfo.middleName, 1), '.', ' ', tbldeceaseinfo.lastName) AS decease_name"),
                DB::raw("CONCAT('Cemetery Name: ', tblplotinvent.cemName, ', Plot #', tblplotinvent.plotNum) AS location"),
                'tblplotinvent.updated_at',
                'totalCost',
                'transactDateTime'
            )
            ->leftJoin('tblmaintenance', 'tbltransaction.maintainRec_ID', '=', 'tblmaintenance.maintainRec_ID')
            ->leftJoin('tbldeceaseinfo', 'tblmaintenance.deceaseID', '=', 'tbldeceaseinfo.deceaseID')
            ->leftJoin('tblplotinvent', 'tbldeceaseinfo.plotInventID', '=', 'tblplotinvent.plotInventID')
            ->leftJoin('tblowner', 'tblplotinvent.ownerID', '=', 'tblowner.ownerID')
            ->where('tblTransaction.transactType', '=', 'purchase')
            ->get();
        dd($cancelTrans);
        return $cancelTrans;
    }




    public function infoTransact(){
        return view('project.TransactionRef');
    }
    
}
