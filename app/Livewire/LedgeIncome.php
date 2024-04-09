<?php

namespace App\Livewire;

use Livewire\Component;

class LedgeIncome extends Component
{
    public function render()
    {
        return view('livewire.ledger.ledge-income')->layout('layouts.app');
    }
}
