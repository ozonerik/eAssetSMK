<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\OrganitationController;
use App\Http\Controllers\BudgetingController;
use App\Http\Controllers\FiscalyearController;
use App\Http\Controllers\ItemtypeController;
use App\Http\Controllers\StorageController;
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
//backend page
Route::group(['middleware' => ['auth']], function () {
    // role untuk yang auth
    Route::get('/dashboard', [DashboardController::class, 'index'] )->name('dashboard');
    //menu profile
    Route::get('/profile', [PenggunaController::class, 'editprofile'])->name('profile');
    Route::put('/profile/update/{id}', [PenggunaController::class, 'updateprofile'])->name('profile.update');
    
    // role untuk admin,kabeng, dan toolman
    Route::group(['middleware' => ['role:admin|kabeng|toolman']], function () {
        //menu budgeting
        Route::get('/budgeting', [BudgetingController::class, 'index'] )->name('budgeting.index');
        //menu fiscal
        Route::get('/fiscal', [FiscalyearController::class, 'index'] )->name('fiscal.index');
        //menu itemtype
        Route::get('/itemtype', [ItemtypeController::class, 'index'] )->name('itemtype.index');
        //menu storage
        Route::get('/storages', [StorageController::class, 'index'] )->name('storages.index');
        //menu inventory
        Route::get('/inventory', [InventoryController::class, 'index'] )->name('inventory.index');
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


