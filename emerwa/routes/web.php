<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\controllers\companyController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//company
Route::get('newcompany',[companyController::class,'newcompany']);
Route::post('createcompany',[companyController::class,'createCompany'])->name('company.create');

Route::get('company',[companyController::class,'company']);
Route::get('ajaxcompany',[companyController::class,'companyDisplay']);

Route::post('getCompanyById',[companyController::class,'edit']);
Route::post('updateCompany',[companyController::class,'update']);

Route::post('deleteCompany',[companyController::class,'deleteCompany']);