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
Route::get('/forgot-password', [CusAuthController::class,'forgPass'])->name('forgPass');
Route::post('/forgot-password', [CusAuthController::class,'forgPassStore'])->name('forgPass.reset');

Route::get('/home', [landingController::class, 'home'])->name('home')->middleware('isLoggedIn');
Route::get('/dashboard', [landingController::class, 'dashboard'])->name('dashboard')->middleware('isLoggedIn');
Route::get('/services', [landingController::class, 'services'])->name('services')->middleware('isLoggedIn');
Route::get('/faq', [landingController::class, 'faq'])->name('faq')->middleware('isLoggedIn');
Route::get('/contacts', [landingController::class, 'contacts'])->name('contacts')->middleware('isLoggedIn');

Route::get('/CemeteryInformation', [dashboardController::class, 'cemInfo'])->name('cemInfo')->middleware('isLoggedIn');
Route::get('/AddCemetery',[dashboardController::class, 'cemAdd'])->name('cemAdd')->middleware('isLoggedIn');
Route::post('/AddCemetery',[dashboardController::class, 'storeCemAdd'])->name('storeCemAdd')->middleware('isLoggedIn');
Route::get('/Purchase',[dashboardController::class, 'purchase'])->name('purchase')->middleware('isLoggedIn');
Route::get('/PurchasePlot',[dashboardController::class, 'buyPlot'])->name('buyPlot')->middleware('isLoggedIn');
Route::post('/PurchasePlot',[dashboardController::class, 'reservePlot'])->name('reserve')->middleware('isLoggedIn');
Route::get('/HistoricalRecord',[dashboardController::class, 'histoRec'])->name('histoRec')->middleware('isLoggedIn');
Route::get('/AddDecease',[dashboardController::class, 'addDecease'])->name('addDecease')->middleware('isLoggedIn');
Route::post('/AddDecease',[dashboardController::class, 'storeDecease'])->name('storeDecease')->middleware('isLoggedIn');
Route::get('/MaintenanceRecord',[dashboardController::class, 'maintainRec'])->name('maintainRec')->middleware('isLoggedIn');
Route::get('/AddMaintenance',[dashboardController::class, 'addMaintain'])->name('addMaintain')->middleware('isLoggedIn');
Route::post('/AddMaintenance',[dashboardController::class, 'storeMaintenance'])->name('storeMaintenance')->middleware('isLoggedIn');
Route::get('/Staff',[dashboardController::class, 'staff'])->name('staff')->middleware('isLoggedIn');
Route::get('/addStaff',[dashboardController::class, 'addStaff'])->name('addStaff')->middleware('isLoggedIn');
Route::post('/addStaff',[dashboardController::class, 'storeStaff'])->name('storeStaff')->middleware('isLoggedIn');
Route::get('/buyerInformation', [dashboardController::class, 'owner'])->name('owner')->middleware('isLoggedIn');
Route::get('/RefundTransaction',[dashboardController::class, 'infoTransact'])->name('infoTransact')->middleware('isLoggedIn');

Route::get('/TransactionInfo',[dashboardController::class, 'transaction'])->name('transaction')->middleware('isLoggedIn');
Route::post('/store-transfer-reason', [dashboardController::class, 'storeTransferReason'])->name('storeTransferReason')->middleware('isLoggedIn');

Route::get('/CancelTransaction',[dashboardController::class, 'transactCancel'])->name('transactCancel')->middleware('isLoggedIn');
Route::post('/storeTransaction',[dashboardController::class, 'cancelTransact'])->name('cancelTransact')->middleware('isLoggedIn');

//Route::get('/CancelTransaction',[dashboardController::class, 'storeCancel'])->name('storeCancel')->middleware('isLoggedIn');

//require __DIR__.'/auth.php';