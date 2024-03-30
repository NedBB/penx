<?php

namespace App\Livewire;

use Livewire\Component;

class TandT extends Component
{
    public function render()
    {
        return view('livewire.entries.tand-t')->layout('layouts.app');
    }
}
