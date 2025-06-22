<?php

namespace App\Livewire;

use Livewire\Component;

class SelectionChange extends Component
{
    public $records;
    public $record_id;
    public $name;
    public $data;
    public $edit;


   
    
    
    public function render()
    {
      
        return view('livewire.selection-change');
    }
}
