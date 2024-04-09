<?php

namespace App\Livewire;

use App\Services\NationalofficeService;
use App\Services\StaffprofileService;
use Livewire\Component;

class Dashboard extends Component
{
    public $staff;
    public $national;

    public function boot(StaffprofileService $staffprofileService, NationalofficeService $nationalofficeService){
        $this->staff = $staffprofileService->staffCount();
        $this->national = $nationalofficeService->nationalCount();
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app');
    }
}
