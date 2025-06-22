<?php

namespace App\Livewire;

use Livewire\Component;

class PrintModal extends Component
{

    public $eventoption = '';
    public $id; 

    public function render()
    {
        return view('livewire.print-modal');
    }
}
