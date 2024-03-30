<?php

namespace App\Livewire;

use Livewire\Component;

class Staff extends Component
{
    public function render()
    {
        return view('livewire.entries.staff')->layout('layouts.app');
    }
}
