<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

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
//login
Route::get('',[UserAuthController::class,'login']);
Route::post('check',[UserAuthController::class,'check'])->name('auth.check');
//logout
Route::get('signout', [UserAuthController::class, 'signOut'])->name('signout');
//auditor
Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'isAdmin:auditor'], function() {
        Route::get('auditor',[AuditorController::class,'auditor']);
    });
});
Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'isAdmin:profile'], function() {
        //email
        Route::get('jk', [MailController::class, 'hai']);
        //add
        Route::get('newuser',[AdminController::class,'NewUser']);
        Route::post('create',[AdminController::class,'create'])->name('admin.create');
        //profile
        Route::get('profile',[AdminController::class,'profile']);
        // display
        Route::get('user',[AdminController::class,'user']);
        Route::get('display',[TableController::class,'userDisplay']);
        //edit
        Route::post('getUserById',[TableController::class,'edit']);
        Route::post('updateUser', [TableController::class,'update']);
        //delete
        Route::post('deleteUser',[TableController::class,'delete']);
        //status
        Route::post('active',[TableController::class,'Active']);
        Route::post('inactive',[TableController::class,'InActive']);

        //employee
        Route::get('employee',[EmployeeController::class,'employee']);
        Route::get('displayemployee',[EmployeeController::class,'userDisplay']);
        //add
        Route::get('newemployee',[EmployeeController::class,'NewEmployee']);
        Route::post('createemployee',[EmployeeController::class,'create'])->name('employee.create');
        //edit
        Route::post('getEmployeeById',[EmployeeController::class,'edit']);
        Route::post('updateEmployees', [EmployeeController::class,'update']);
        //delete
        Route::post('deleteEmployee',[EmployeeController::class,'delete']);
        //state
        Route::post('get-states-by-country',[EmployeeController::class,'getState']);
    });
});
