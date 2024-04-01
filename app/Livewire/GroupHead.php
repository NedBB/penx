<?php

namespace App\Livewire;

use App\Services\GroupheadService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class GroupHead extends Component
{
    use WithPagination;

    public $name; 
    public $id;
    public $head;
    public $title = "Add Group Head";
    public $edittitle = "Edit Group Head";
    public $addevent= "add-group-head";
    public $editevent = "edit-group-head";
    public $slug;
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-group-head')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Group Head";
        $this->reset(['name','slug']);
    }

    public function save(GroupheadService $service){

        $validated = $this->validate([ 
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3'
        ]);

        $response = $service->create($validated,'head');

        $this->reset(['name','slug']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(GroupheadService $service){
        $validated = $this->validate([ 
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3'
        ]);

        $response = $service->updateHead($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-group-head')]
    public function edit($id, GroupheadService $service){
      
        $this->title = "edit group head";
        $this->edit = true;
        $this->head = $service->getById($id, 'head');
        $this->name = $this->head->name;
        $this->slug = $this->head->slug;
        $this->id = $this->head->id;
    }

    public function delete($id,GroupheadService $service){
        $service->delete($id, 'head');
    }

    public function render(GroupheadService $service)
    {
        $heads = $service->list($this->perpage, $this->search);
        return view('livewire.settings.group-head', compact('heads'))->layout('layouts.app');
    }
}
