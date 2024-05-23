<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CusAuthController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\landingController;

Route::get('/', function () {
    return view('auth.login'); 
})->middleware('adminLogIn');
Route::get('/login',[CusAuthController::class,'logIn'])->name('signin')->middleware('adminLogIn');
Route::post('/loginStore',[CusAuthController::class,'storelogIn'])->name('storeLogIn')->middleware('adminLogIn');
Route::get('/registration',[CusAuthController::class,'registration'])->name('register')->middleware('adminLogIn');
Route::post('/registeredUser',[CusAuthController::class,'storeRegister'])->name('storeRegister')->middleware('adminLogIn');
Route::get('/logout', [CusAuthController::class,'logout'])->name('logout')->middleware('adminLogIn');
Route::get('/forgot-password', [CusAuthController::class,'forgPass'])->name('forgPass')->middleware('adminLogIn');
Route::post('/forgot-password', [CusAuthController::class,'forgPassStore'])->name('forgPass.reset')->middleware('adminLogIn');

Route::get('/home', [landingController::class, 'home'])->name('home')->middleware('adminAuth');
Route::get('/dashboard', [landingController::class, 'dashboard'])->name('dashboard')->middleware('adminAuth');
Route::get('/services', [landingController::class, 'services'])->name('services')->middleware('adminAuth');
Route::get('/faq', [landingController::class, 'faq'])->name('faq')->middleware('adminAuth');
Route::get('/contacts', [landingController::class, 'contacts'])->name('contacts')->middleware('adminAuth');

Route::get('/CemeteryInformation', [dashboardController::class, 'cemInfo'])->name('cemInfo')->middleware('adminAuth');
Route::get('/AddCemetery',[dashboardController::class, 'cemAdd'])->name('cemAdd')->middleware('adminAuth');
Route::post('/AddCemetery',[dashboardController::class, 'storeCemAdd'])->name('storeCemAdd')->middleware('adminAuth');
Route::get('/Purchase',[dashboardController::class, 'purchase'])->name('purchase')->middleware('adminAuth');
Route::get('/PurchasePlot',[dashboardController::class, 'buyPlot'])->name('buyPlot')->middleware('adminAuth');
Route::post('/PurchasePlot',[dashboardController::class, 'reservePlot'])->name('reserve')->middleware('adminAuth');
Route::get('/HistoricalRecord',[dashboardController::class, 'histoRec'])->name('histoRec')->middleware('adminAuth');
Route::get('/AddDecease',[dashboardController::class, 'addDecease'])->name('addDecease')->middleware('adminAuth');
Route::post('/AddDecease',[dashboardController::class, 'storeDecease'])->name('storeDecease')->middleware('adminAuth');
Route::get('/MaintenanceRecord',[dashboardController::class, 'maintainRec'])->name('maintainRec')->middleware('adminAuth');
Route::get('/AddMaintenance',[dashboardController::class, 'addMaintain'])->name('addMaintain')->middleware('adminAuth');
Route::post('/AddMaintenance',[dashboardController::class, 'storeMaintenance'])->name('storeMaintenance')->middleware('adminAuth');
Route::get('/Staff',[dashboardController::class, 'staff'])->name('staff')->middleware('adminAuth');
Route::get('/addStaff',[dashboardController::class, 'addStaff'])->name('addStaff')->middleware('adminAuth');
Route::post('/addStaff',[dashboardController::class, 'storeStaff'])->name('storeStaff')->middleware('adminAuth');
Route::get('/buyerInformation', [dashboardController::class, 'owner'])->name('owner')->middleware('adminAuth');
Route::get('/RefundTransaction',[dashboardController::class, 'infoTransact'])->name('infoTransact')->middleware('adminAuth');

Route::get('/TransactionInfo',[dashboardController::class, 'transaction'])->name('transaction')->middleware('adminAuth');
Route::post('/store-transfer-reason', [dashboardController::class, 'storeTransferReason'])->name('storeTransferReason')->middleware('adminAuth');

Route::get('/CancelTransaction',[dashboardController::class, 'transactCancel'])->name('transactCancel')->middleware('adminAuth');
Route::post('/storeTransaction',[dashboardController::class, 'cancelTransact'])->name('cancelTransact')->middleware('adminAuth');

Route::get('generate-pdf', [App\Http\Controllers\pdfController::class, 'generatePDF'])->name('generatePDF');
//require __DIR__.'/auth.php';