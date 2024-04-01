<?php

namespace App\Livewire;

use App\Services\DepartmentService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class Department extends Component
{
    use WithPagination;

    public $name; 
    public $id;
    public $department;
    public $title = "Add Department";
    public $edittitle = "Edit Department";
    public $addevent= "add-department";
    public $editevent = "edit-department";
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-department')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Department";
        $this->reset(['name']);
    }

    public function save(DepartmentService $service){

        $validated = $this->validate([ 
            'name' => 'required|min:3'
        ]);

        $response = $service->create($validated);

        $this->reset(['name']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(DepartmentService $service){
        $validated = $this->validate([ 
            'name' => 'required|min:3'
        ]);

        $response = $service->update($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-department')]
    public function edit($id, DepartmentService $service){
      
        $this->title = "edit department";
        $this->edit = true;
        $this->department = $service->getById($id);
        $this->name = $this->department->name;
        $this->id = $this->department->id;
       
    }

    public function delete($id,DepartmentService $service){
        $service->delete($id);
    }

    
    public function render(DepartmentService $service)
    {
        $departments = $service->list($this->perpage, $this->search);
        return view('livewire.settings.department',compact('departments'))->layout('layouts.app');
    }
}
