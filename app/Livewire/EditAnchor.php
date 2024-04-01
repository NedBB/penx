<?php

namespace App\Livewire;

use Livewire\Component;

class EditAnchor extends Component
{
    public $record; 
    public $eventoption = '';

    public function edit(){

    }

    public function render()
    {
       // dd($this->eventoption);
        return view('livewire.edit-anchor');
    }
}
