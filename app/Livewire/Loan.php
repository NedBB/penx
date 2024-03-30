<?php

namespace App\Livewire;

use App\Services\LoanService;
use Livewire\Component;
use Livewire\WithPagination;

class Loan extends Component
{
    use WithPagination;

    public function render(LoanService $service)
    {
        $loans = $service->list();
        return view('livewire.settings.loan',compact('loans'))->layout('layouts.app');
    }
}
