<?php

namespace App\Livewire;

use App\Services\LocationService;
use Livewire\Component;

class LedgeIncome extends Component
{
    public $states;
    public $show = true;

    public function boot(LocationService $locationService){
        $this->states = $locationService->listState();
    }
    public function render()
    {
        return view('livewire.ledgers.ledge-income')->layout('layouts.app');
    }
}
