<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
class Printer extends Component
{
    public $header;
    public $component;
    public $eventoption;
    public $records = [];

    #[On('summarized')]
    public function printData($records, $component){
        $this->component = $component;
        $this->records = $records;
    }

    public function render()
    {
        return view('livewire.printer')->layout('layouts.printer');
    }
}
