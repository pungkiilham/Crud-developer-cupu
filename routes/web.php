<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai');
//Route::get('/tambahpegawai',[EmployeeController::class, 'tambahdata'])->name('tambahdata');
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');
Route::get('/tambahpegawai', function () {
    return view('tambahdata');
});

Route::get('/ubahdata/{id}', [EmployeeController::class, 'ubahdata'])->name('ubahdata');
Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');

Route::get('/hapusdata/{id}', [EmployeeController::class, 'hapusdata'])->name('hapusdata');

//export PDF
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');

//export Excel
Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');

//import Excel
Route::post('/importexcel', [EmployeeController::class, 'importexcel'])->name('importexcel');