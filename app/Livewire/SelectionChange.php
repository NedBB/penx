<?php

namespace App\Livewire;

use Livewire\Component;

class SelectionChange extends Component
{
    public $heads;
    
    public function render()
    {
        return view('livewire.selection-change');
    }
}
