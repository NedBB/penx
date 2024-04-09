<?php

namespace App\Livewire;

use App\Services\BankService;
use App\Services\NationalofficeService;
use App\Services\StaffprofileService;
use Livewire\Component;

class Dashboard extends Component
{
    public $staff;
    public $national;
    public $account;
    public $bank;

    public function boot(StaffprofileService $staffprofileService, BankService $bankService, NationalofficeService $nationalofficeService){
        $this->staff = $staffprofileService->staffCount();
        $this->national = $nationalofficeService->nationalCount();
        $this->account = $bankService->accoutCount();
        $this->bank = $bankService->bankCount();
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app');
    }
}
