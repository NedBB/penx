<?php

namespace App\Livewire;

use Livewire\Component;

class Loans extends Component
{
    public function render()
    {
        return view('livewire.entries.loans')->layout('layouts.app');
    }
}
