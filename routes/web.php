<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\OrganitationController;
use App\Http\Controllers\BudgetingController;
use App\Http\Controllers\FiscalyearController;
use App\Http\Controllers\ItemtypeController;
use App\Http\Controllers\StoreroomController;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend page
Route::get('/', function () {return view('pages.home');});
Route::get('/home', function () {return view('pages.home');})->name('home');
Route::get('/login', [LoginController::class, 'getLogin'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'postLogin']);
Route::post('/logout', [LoginController::class, 'logout']);
//cek barang
Route::get('/cek/{code}', [InventoryController::class, 'cek'] )->name('inventory.cek');
//backend page
Route::group(['middleware' => ['auth']], function () {
    //Route::get('/cek/{code}', [InventoryController::class, 'cek'] )->name('inventory.cek');
    // role untuk yang auth
    Route::get('/dashboard', [DashboardController::class, 'index'] )->name('dashboard');
    //menu profile
    Route::get('/profile', [PenggunaController::class, 'editprofile'])->name('profile');
    Route::put('/profile/update/{id}', [PenggunaController::class, 'updateprofile'])->name('profile.update');
    
    // role untuk admin,kabeng, dan toolman
    Route::group(['middleware' => ['role:admin|kabeng|toolman']], function () {
        //menu budgeting
        Route::get('/budgeting', [BudgetingController::class, 'index'] )->name('budgeting.index');
        Route::get('/budgeting/add', [BudgetingController::class, 'create'] )->name('budgeting.create');
        Route::post('/budgeting/store', [BudgetingController::class, 'store'] )->name('budgeting.store');
        Route::get('/budgeting/edit/{id}', [BudgetingController::class, 'edit'] )->name('budgeting.edit');
        Route::post('/budgeting/update/{id}', [BudgetingController::class, 'update'] )->name('budgeting.update');
        Route::delete('/budgeting/del/{id}', [BudgetingController::class, 'destroy'] )->name('budgeting.del');
        //menu fiscal
        Route::get('/fiscal', [FiscalyearController::class, 'index'] )->name('fiscal.index');
        Route::get('/fiscal/add', [FiscalyearController::class, 'create'] )->name('fiscal.create');
        Route::post('/fiscal/store', [FiscalyearController::class, 'store'] )->name('fiscal.store');
        Route::get('/fiscal/edit/{id}', [FiscalyearController::class, 'edit'] )->name('fiscal.edit');
        Route::post('/fiscal/update/{id}', [FiscalyearController::class, 'update'] )->name('fiscal.update');
        Route::delete('/fiscal/del/{id}', [FiscalyearController::class, 'destroy'] )->name('fiscal.del');
        //menu itemtype
        Route::get('/itemtype', [ItemtypeController::class, 'index'] )->name('itemtype.index');
        Route::get('/itemtype/add', [ItemtypeController::class, 'create'] )->name('itemtype.create');
        Route::post('/itemtype/store', [ItemtypeController::class, 'store'] )->name('itemtype.store');
        Route::get('/itemtype/edit/{id}', [ItemtypeController::class, 'edit'] )->name('itemtype.edit');
        Route::post('/itemtype/update/{id}', [ItemtypeController::class, 'update'] )->name('itemtype.update');
        Route::delete('/itemtype/del/{id}', [ItemtypeController::class, 'destroy'] )->name('itemtype.del');
        //menu storage
        Route::get('/storeroom', [StoreroomController::class, 'index'] )->name('storeroom.index');
        Route::get('/storeroom/add', [StoreroomController::class, 'create'] )->name('storeroom.create');
        Route::post('/storeroom/store', [StoreroomController::class, 'store'] )->name('storeroom.store');
        Route::get('/storeroom/edit/{id}', [StoreroomController::class, 'edit'] )->name('storeroom.edit');
        Route::post('/storeroom/update/{id}', [StoreroomController::class, 'update'] )->name('storeroom.update');
        Route::delete('/storeroom/del/{id}', [StoreroomController::class, 'destroy'] )->name('storeroom.del');
        //menu inventory
        Route::get('/inventory', [InventoryController::class, 'index'] )->name('inventory.index');
        Route::get('/inventory/add', [InventoryController::class, 'create'] )->name('inventory.create');
        Route::post('/inventory/store', [InventoryController::class, 'store'] )->name('inventory.store');
        Route::get('/inventory/graph', [InventoryController::class, 'grafik'] )->name('inventory.graph');
        Route::get('/inventory/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::post('/inventory/update/{id}', [InventoryController::class, 'update'])->name('inventory.update');
        Route::delete('/inventory/del/{id}', [InventoryController::class, 'destroy'])->name('inventory.del');
    });
    
    
    // role untuk admin
    Route::group(['middleware' => ['role:admin']], function () {
        // menu pengguna
        Route::get('/pengguna', [PenggunaController::class, 'index'] )->name('pengguna.index');
        Route::get('/pengguna/add', [PenggunaController::class, 'create'] )->name('pengguna.create');
        Route::post('/pengguna/store', [PenggunaController::class, 'store'] )->name('pengguna.store');
        Route::get('/pengguna/export', [PenggunaController::class, 'user_export'] )->name('pengguna.export');
        Route::post('/pengguna/import', [PenggunaController::class, 'user_import'] )->name('pengguna.import');
        Route::get('/pengguna/edit/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('/pengguna/update/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/del/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.del');
        Route::delete('/penggunas/delSel', [PenggunaController::class, 'deleteSel'])->name('pengguna.delsel');
        Route::post('/pengguna/roleSel', [PenggunaController::class, 'roleSel'] )->name('pengguna.roleSel');
        //menu organitation
        Route::get('/organitation', [OrganitationController::class, 'index'] )->name('organitation.index');
    });
    

});


