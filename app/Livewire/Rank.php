<?php

namespace App\Livewire;

use App\Services\RankService;
use Livewire\Component;
use Livewire\WithPagination;

class Rank extends Component
{
    use WithPagination;

    public function render(RankService $service)
    {
        $ranks = $service->list();
        return view('livewire.settings.rank', compact('ranks'))->layout('layouts.app');
    }
}
