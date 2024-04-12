<?php

namespace App\Livewire;

use Livewire\Component;

class Printer extends Component
{
    public $header;
    public $component;

    public function render()
    {
        return view('livewire.printer')->layout('layouts.printer');
    }
}
