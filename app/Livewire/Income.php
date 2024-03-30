<?php

namespace App\Livewire;

use Livewire\Component;

class Income extends Component
{
    public function render()
    {
        return view('livewire.entries.income')->layout('layouts.app');
    }
}
