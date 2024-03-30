<?php

namespace App\Livewire;

use Livewire\Component;

class NationalStaff extends Component
{
    public function render()
    {
        return view('livewire.entries.national-staff')->layout('layouts.app');
    }
}
