<?php

namespace App\Livewire;

use App\Services\GeneralsettingService;
use Livewire\Component;
use Livewire\WithPagination;

class GeneralSetting extends Component
{
    use WithPagination;
    
    public function render(GeneralsettingService $service)
    {
        $settings = $service->list();
        return view('livewire.settings.general-setting',compact('settings'))->layout('layouts.app');
    }
}
