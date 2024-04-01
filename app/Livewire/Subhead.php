<?php

namespace App\Livewire;

use App\Services\GroupheadService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Subhead extends Component
{
    use WithPagination;

    public $name; 
    public $id;
    public $sub;
    public $title = "Add Sub Head";
    public $edittitle = "Edit Sub Head";
    public $addevent= "add-sub-head";
    public $editevent = "edit-sub-head";
    public $head_id;
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-sub-head')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Sub Head";
        $this->reset(['name','head_id']);
    }

    public function save(GroupheadService $service){

        $validated = $this->validate([ 
            'name' => 'required|string|min:3',
            'head_id' => 'required|numeric'
        ]);

        $response = $service->create($validated,'sub');

        $this->reset(['name','head_id']);

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
            'head_id' => 'required|numeric'
        ]);

        $response = $service->updateSubHead($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-sub-head')]
    public function edit($id, GroupheadService $service){
      
        $this->title = "edit sub head";
        $this->edit = true;
        $this->sub = $service->getById($id, 'sub');
        $this->name = $this->sub->name;
        $this->head_id = $this->sub->head_id;
        $this->id = $this->sub->id;
    }

    public function delete($id,GroupheadService $service){
        $service->delete($id, 'sub');
    }
    public function render(GroupheadService $service)
    {
        $heads = $service->headList();
        $subs = $service->subHeadList($this->perpage,$this->search);
        return view('livewire.settings.subhead',compact('subs','heads'))->layout('layouts.app');
    }
}
