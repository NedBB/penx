<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class SelectionUpdate extends Component
{
    public $subheads;
    public $subhead_id;

   
    #[On('messageSent')] 
    public function receiveMessage($data)
    {
        $this->subheads = $data;
    }

    public function render()
    {
        return view('livewire.selection-update');
    }
}
