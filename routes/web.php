<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CusAuthController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\LandingController;

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
Route::get('/reset-password/{token}', [CusAuthController::class,'resetPass'])->name('resetPass');
Route::post('/resetPassword', [CusAuthController::class,'resetPassStore'])->name('resetPass.post');

Route::get('/home', [LandingController::class, 'home'])->name('home')->middleware('isLoggedIn');
Route::get('/dashboard', [LandingController::class, 'dashboard'])->name('dashboard')->middleware('isLoggedIn');
Route::get('/services', [LandingController::class, 'services'])->name('services')->middleware('isLoggedIn');
Route::get('/faq', [LandingController::class, 'faq'])->name('faq')->middleware('isLoggedIn');
Route::get('/contacts', [LandingController::class, 'contacts'])->name('contacts')->middleware('isLoggedIn');

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
Route::post('/store-transfer-reason', [dashboardController::class, 'storeTransferReason'])->name('storeTransferReason')->middleware('isLoggedIn');
Route::get('/AddMaintenance',[dashboardController::class, 'addMaintain'])->name('addMaintain')->middleware('isLoggedIn');
Route::post('/AddMaintenance',[dashboardController::class, 'storeMaintenance'])->name('storeMaintenance')->middleware('isLoggedIn');
Route::get('/Staff',[dashboardController::class, 'staff'])->name('staff')->middleware('isLoggedIn');
Route::get('/addStaff',[dashboardController::class, 'addStaff'])->name('addStaff')->middleware('isLoggedIn');
Route::post('/addStaff',[dashboardController::class, 'storeStaff'])->name('storeStaff')->middleware('isLoggedIn');
Route::get('/buyerInformation', [dashboardController::class, 'owner'])->name('owner')->middleware('isLoggedIn');
Route::get('/TransactionInfo',[dashboardController::class, 'transaction'])->name('transaction')->middleware('isLoggedIn');
Route::get('/CancelTransaction',[dashboardController::class, 'cancelTransact'])->name('cancelTransact')->middleware('isLoggedIn');
Route::get('/RefundTransaction',[dashboardController::class, 'infoTransact'])->name('infoTransact')->middleware('isLoggedIn');
Route::post('/store-transact', [dashboardController::class, 'transStore'])->name('transStore');
Route::get('/storeTransaction',[dashboardController::class, 'transactCancel'])->name('transactCancel')->middleware('isLoggedIn');

//Route::get('/CancelTransaction',[dashboardController::class, 'storeCancel'])->name('storeCancel')->middleware('isLoggedIn');

//require __DIR__.'/auth.php';