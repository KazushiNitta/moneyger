<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfitAndLossController;
use App\Http\Controllers\YearOnYearController;

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

Route::resource('user', UserController::class)
->middleware(['auth']);

Route::resource('income', IncomeController::class)
->middleware(['auth'])->except(['show']);

Route::resource('expense', ExpenseController::class)
->middleware(['auth'])->except(['show']);

Route::resource('profit-and-loss', ProfitAndLossController::class)
->middleware(['auth'])->only(['index']);

Route::resource('year-on-year', YearOnYearController::class)
->middleware(['auth'])->only(['index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
