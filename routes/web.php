<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;

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
    return view('auth.login');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('admin.')->prefix('admin')->middleware(['role:admin'])->group(function (){

        Route::prefix('company')->name('company.')->group(function (){
            Route::get('create', [CompanyController::class, 'create'])->name('create');
            Route::post('store', [CompanyController::class, 'store'])->name('store');
            Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('edit');
            Route::put('update/{company}', [CompanyController::class, 'update'])->name('update');
            Route::get('destroy/{company}', [CompanyController::class, 'destroy'])->name('destroy');
        });
    });
});
