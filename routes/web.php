<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

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
Route::get('/income', [App\Http\Controllers\HomeController::class, 'income'])->name('income');
Route::get('/expense', [App\Http\Controllers\HomeController::class, 'expense'])->name('expense');
Route::get('/profit', [App\Http\Controllers\HomeController::class, 'profit'])->name('profit');
Route::post('/income-title-add', [App\Http\Controllers\HomeController::class, 'incomeTitleAdd'])->name('income-title-add');
Route::get('/get-income-title', [App\Http\Controllers\HomeController::class, 'getIncomeTitle'])->name('get-income-title');

// Profit Routes
Route::post('/profit-details', [App\Http\Controllers\HomeController::class, 'profitDetials']);

// Income Routes
Route::post('/add-income-form', [IncomeController::class, 'addIncomeStore']);
Route::get('/get-income', [IncomeController::class, 'index'])->name('get-name');
Route::get('/income/get-edit-data/{id}', [IncomeController::class, 'getEditData']);
Route::post('/income-update', [IncomeController::class, 'updateIncome']);
Route::post('/income/delete', [IncomeController::class, 'deleteIncome'])->name('delete.income');

// Expense Routes
Route::post('/add-expense-form', [ExpenseController::class, 'addExpenseStore']);
Route::get('/get-expense', [ExpenseController::class, 'index']);
Route::get('/expense/get-edit-data/{id}', [ExpenseController::class, 'getEditData']);
Route::post('/expense-update', [ExpenseController::class, 'updateExpense']);
Route::post('/expense/delete', [ExpenseController::class, 'deleteExpense'])->name('delete.expense');
