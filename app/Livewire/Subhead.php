<?php

namespace App\Livewire;

use App\Services\GroupheadService;
use Livewire\Component;
use Livewire\WithPagination;

class Subhead extends Component
{
    use WithPagination;

    public function render(GroupheadService $service)
    {
        $subs = $service->subHeadList();
        return view('livewire.settings.subhead',compact('subs'))->layout('layouts.app');
    }
}
