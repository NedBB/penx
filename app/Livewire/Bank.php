<?php

namespace App\Livewire;

use App\Services\BankService;
use Livewire\Component;
use Livewire\WithPagination;

class Bank extends Component
{
    use WithPagination;

    public function render(BankService $service)
    {
        $banks = $service->bankList();
        return view('livewire.settings.bank',compact('banks'))->layout('layouts.app');
    }
}
