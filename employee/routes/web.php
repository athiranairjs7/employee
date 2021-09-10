<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\DB;
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
    $company_count = DB::table('company')->where('is_deleted',0)->count();
    $all_company_count = DB::table('company')->count();
    $employee_count = DB::table('employee')->count();
    return view('welcome',compact('company_count','employee_count','all_company_count'));
});
Route::get('company',[CompanyController::class,'index']);
Route::get('ajaxcompany',[CompanyController::class,'ajax']);

Route::get('allcompany',[CompanyController::class,'allindex']);
Route::get('allajaxcompany',[CompanyController::class,'allajax']);
Route::post('active',[CompanyController::class,'Active']);

Route::get('createcompany',[CompanyController::class,'getCreateForm']);
Route::post('createcompany',[CompanyController::class,'create'])->name('company.create');

Route::get('editcompany/{companyId}',[CompanyController::class,'getCompanyById']);
Route::post('editcompany/{companyId}',[CompanyController::class,'update']);

Route::post('deletecompany',[CompanyController::class,'delete']);


Route::get('employee',[EmployeeController::class,'index']);
Route::get('ajaxemployee',[EmployeeController::class,'ajaxemployee']);

Route::get('createemployee',[EmployeeController::class,'getemployeeForm']);
Route::post('createemployee',[EmployeeController::class,'create'])->name('employee.create');

Route::get('editemployee/{employeeId}',[EmployeeController::class,'getEmployeeById']);
Route::post('editemployee/{employeeId}',[EmployeeController::class,'update']);

Route::post('deleteemployee',[EmployeeController::class,'delete']);