<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Services\ContractorService;
use Livewire\WithPagination;

class Contractor extends Component
{
    use WithPagination;

    public function render(ContractorService $service)
    {
        
        $contractors = $service->list();
       
        return view('livewire.settings.contractor', compact('contractors'))->layout('layouts.app');
    }
}
