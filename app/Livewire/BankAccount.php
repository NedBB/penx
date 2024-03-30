<?php

namespace App\Livewire;

use App\Services\BankService;
use Livewire\Component;
use Livewire\WithPagination;

class BankAccount extends Component
{
    use WithPagination;
    
    public function render(BankService $service)
    {
        $accounts = $service->accountList();
        return view('livewire.settings.bank-account', compact('accounts'))->layout('layouts.app');
    }
}
