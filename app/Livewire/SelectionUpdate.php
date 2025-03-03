<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class SelectionUpdate extends Component
{
    public $records = [];
    public $recordx_id;
    public $name;
    public $type;

   
    #[On('messageSent')] 
    public function receiveMessage($data)
    {
       
        $this->records = $data;
    }

    public function render()
    {
        return view('livewire.selection-update');
    }
}
