<?php

namespace App\Livewire;

use App\Services\OmnibusService;
use Livewire\Component;
use Livewire\WithPagination;

class Ominbus extends Component
{
    use WithPagination;

    public function render(OmnibusService $service)
    {
        $omnibus = $service->list();
        return view('livewire.entries.ominbus',compact('omnibus'))->layout('layouts.app');
    }
}
