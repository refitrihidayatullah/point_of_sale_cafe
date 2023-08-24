<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\SupplierAdmin;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardAdmin::class, 'index']);
Route::get('/supplier', [SupplierAdmin::class, 'index']);
Route::get('/supplier/create', [SupplierAdmin::class, 'create']);
Route::post('/supplier', [SupplierAdmin::class, 'store']);
Route::get('/supplier/{id}/edit', [SupplierAdmin::class, 'edit']);
Route::put('/supplier/{id}', [SupplierAdmin::class, 'update']);
Route::get('/supplier/{id}', [SupplierAdmin::class, 'destroy']);
