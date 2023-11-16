<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::get('/{nome}/registrar', [EmployeeController::class, 'register']);
Route::post('/registro/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');

Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('/registros', [EmployeeController::class, 'index'])->name('employees');

	Route::get('/{nome}/validar', [EmployeeController::class, 'show'])->name('employee.show');

	Route::post('/registro/validar/{id}', [EmployeeController::class, 'validate'])->name('employee.validate');
	Route::post('/registro/request/new', [EmployeeController::class, 'storeTempEmployeer'])->name('employee.request.new');
});

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
