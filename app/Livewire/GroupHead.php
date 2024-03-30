<?php

namespace App\Livewire;

use App\Services\GroupheadService;
use Livewire\Component;
use Livewire\WithPagination;

class GroupHead extends Component
{
    use WithPagination;

    public function render(GroupheadService $service)
    {
        $heads = $service->list();
        return view('livewire.settings.group-head', compact('heads'))->layout('layouts.app');
    }
}
