<?php

namespace App\Livewire;

use App\Services\LocationService;
use Livewire\Component;
use Livewire\WithPagination;

class StateParastatal extends Component
{
    use WithPagination;

    public function render(LocationService $service)
    {
        $states = $service->list();
        return view('livewire.settings.state-parastatal', compact('states'))->layout('layouts.app');
    }
}
