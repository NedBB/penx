<?php

namespace App\Livewire;

use App\Services\DepartmentService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class Department extends Component
{
    use WithPagination;

   // #[Validate('required')]
    public $name; 

    public function save(DepartmentService $service){

        $validated = $this->validate([ 
            'name' => 'required|min:3'
        ]);

        $service->create($validated);
    }

    
    public function render(DepartmentService $service)
    {
        $departments = $service->list();
        return view('livewire.settings.department',compact('departments'))->layout('layouts.app');
    }
}
