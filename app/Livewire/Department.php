<?php

namespace App\Livewire;

use App\Services\DepartmentService;
use Livewire\Component;
use Livewire\WithPagination;

class Department extends Component
{
    use WithPagination;
    
    public function render(DepartmentService $service)
    {
        $departments = $service->list();
        return view('livewire.settings.department',compact('departments'))->layout('layouts.app');
    }
}
