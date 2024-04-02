<?php

namespace App\Livewire;

use App\Services\LocationService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class StateParastatal extends Component
{
    use WithPagination;
    public $name; 
    public $id;
    public $state;
    public $title = "Add State & Parastatal";
    public $edittitle = "Edit State & Parastatal";
    public $addevent= "add-state-parastatal";
    public $editevent = "edit-state-parastatal";

    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-state-parastatal')]
    public function add(){
        $this->edit = false;
        $this->title = "Add State & Parastatal";
        $this->reset(['name']);
    }

    public function save(LocationService $service){

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

    public function update(LocationService $service){
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

    #[On('edit-state-parastatal')]
    public function edit($id, LocationService $service){
      
        $this->title = "edit state & parastatal";
        $this->edit = true;
        $this->state = $service->getById($id);
        $this->name = $this->state->name;
        $this->id = $this->state->id;
    }

    public function delete($id,LocationService $service){
        $service->delete($id);
    }

    public function render(LocationService $service)
    {
        $states = $service->listState($this->perpage, $this->search);
        return view('livewire.settings.state-parastatal', compact('states'))->layout('layouts.app');
    }
}
