<?php

namespace App\Livewire;

use App\Services\SystemuserService;
use Livewire\Component;
use Livewire\WithPagination;

class SystemUser extends Component
{
    use WithPagination;

    public function render(SystemuserService $service)
    {
        $users = $service->list();
        return view('livewire.settings.system-user', compact('users'))->layout('layouts.app');
    }
}
