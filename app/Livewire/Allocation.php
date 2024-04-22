<?php

namespace App\Livewire;

use App\Services\AllocationService;
use Livewire\Component;

class Allocation extends Component
{
    public function render(AllocationService $allocationService)
    {
        //$allocations = $allocations
        return view('livewire.entries.allocation')->layout('layouts.app');
    }
}
