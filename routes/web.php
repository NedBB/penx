<?php

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/conposs', function () {
    return view('settings.conposs');
})->middleware(['auth', 'verified'])->name('conposs');

Route::get('/contractors', function () {
    return view('settings.contractors');
})->middleware(['auth', 'verified'])->name('contractors');

Route::get('/group/head', function () {
    return view('settings.group-head');
})->middleware(['auth', 'verified'])->name('group-head');

Route::get('/loan', function () {
    return view('settings.loan');
})->middleware(['auth', 'verified'])->name('loan');

Route::get('/bank', function () {
    return view('settings.bank');
})->middleware(['auth', 'verified'])->name('bank');

Route::get('/bank/account', function () {
    return view('settings.bank-account');
})->middleware(['auth', 'verified'])->name('bank-account');

Route::get('/state/parastatal', function () {
    return view('settings.state-parastatal');
})->middleware(['auth', 'verified'])->name('state-parastatal');

Route::get('/rank', function () {
    return view('settings.rank');
})->middleware(['auth', 'verified'])->name('rank');

Route::get('/system/users', function () {
    return view('settings.system-users');
})->middleware(['auth', 'verified'])->name('system-users');

Route::get('/departments', function () {
    return view('settings.departments');
})->middleware(['auth', 'verified'])->name('departments');

Route::get('/general/settings', function () {
    return view('settings.general-settings');
})->middleware(['auth', 'verified'])->name('general-settings');







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
