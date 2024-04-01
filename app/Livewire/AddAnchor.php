<?php

namespace App\Livewire;

use Livewire\Component;

class AddAnchor extends Component
{
    public $eventoption = '';

    public function render()
    {
        return view('livewire.add-anchor');
    }
}
