<?php

namespace App\Livewire;

use App\Services\ConpossService;
use Livewire\Component;
use Livewire\WithPagination;

class Conposs extends Component
{
    use WithPagination;

    public function render(ConpossService $service)
    {
        $conposses = $service->list();
        //dd($conposses);
        return view('livewire.settings.conposs',compact('conposses'))->layout('layouts.app');
    }
}
