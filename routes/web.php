<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Allocation;
use App\Livewire\Bank;
use App\Livewire\BankAccount;
use App\Livewire\Conposs;
use App\Livewire\Contract;
use Illuminate\Support\Facades\Route;
use App\Livewire\Contractor;
use App\Livewire\ContributoryPension;
use App\Livewire\Deduction;
use App\Livewire\Department;
use App\Livewire\GeneralSetting;
use App\Livewire\GroupHead;
use App\Livewire\Income;
use App\Livewire\Loan;
use App\Livewire\Loans;
use App\Livewire\NationalStaff;
use App\Livewire\Ominbus;
use App\Livewire\PaymentSchedule;
use App\Livewire\Rank;
use App\Livewire\Staff;
use App\Livewire\StateParastatal;
use App\Livewire\Subhead;
use App\Livewire\SystemUser;
use App\Livewire\TandT;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/conposs', Conposs::class)->middleware(['auth', 'verified'])->name('conposs');
Route::get('/contractors', Contractor::class)->middleware(['auth', 'verified'])->name('contractors');
Route::get('/group/head', GroupHead::class)->middleware(['auth', 'verified'])->name('group-head');
Route::get('/sub/head', Subhead::class)->middleware(['auth', 'verified'])->name('sub-head');
Route::get('/loan',Loan::class)->middleware(['auth', 'verified'])->name('loan');
Route::get('/bank',Bank::class)->middleware(['auth', 'verified'])->name('bank');
Route::get('/bank/account', BankAccount::class)->middleware(['auth', 'verified'])->name('bank-account');
Route::get('/state/parastatal', StateParastatal::class)->middleware(['auth', 'verified'])->name('state-parastatal');
Route::get('/rank', Rank::class)->middleware(['auth', 'verified'])->name('rank');
Route::get('/system/users', SystemUser::class)->middleware(['auth', 'verified'])->name('system-users');
Route::get('/departments', Department::class)->middleware(['auth', 'verified'])->name('departments');
Route::get('/general/settings', GeneralSetting::class)->middleware(['auth', 'verified'])->name('general-settings');

//Entries
Route::get('/omnibus', Ominbus::class)->middleware(['auth', 'verified'])->name('omnibus');
Route::get('/allocation', Allocation::class)->middleware(['auth', 'verified'])->name('allocation');
Route::get('/loans', Loans::class)->middleware(['auth', 'verified'])->name('loans');
Route::get('/contract', Contract::class)->middleware(['auth', 'verified'])->name('contract');
Route::get('/officers', NationalStaff::class)->middleware(['auth', 'verified'])->name('national.officer');
Route::get('/staff', Staff::class)->middleware(['auth', 'verified'])->name('staff');
Route::get('/income', Income::class)->middleware(['auth', 'verified'])->name('income');
Route::get('/transport/travel', TandT::class)->middleware(['auth', 'verified'])->name('t.t');

//Queries
Route::get('/deductions', Deduction::class)->middleware(['auth', 'verified'])->name('deductions');
Route::get('/payment/schedule', PaymentSchedule::class)->middleware(['auth', 'verified'])->name('payment-schedule');
Route::get('/contributory/pension', ContributoryPension::class)->middleware(['auth', 'verified'])->name('contributory-pension');







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
