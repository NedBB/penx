<?php

namespace App\Livewire;

use App\Services\RankService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Rank extends Component
{
    use WithPagination;

    public $name; 
    public $id;
    public $rank;
    public $title = "Add Rank";
    public $edittitle = "Edit Rank";
    public $addevent= "add-rank";
    public $editevent = "edit-rank";
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-rank')]
    public function add(){
        $this->edit = false;
        $this->title = "Add rank";
        $this->reset(['name']);
    }

    public function save(RankService $service){

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

    public function update(RankService $service){
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

    #[On('edit-rank')]
    public function edit($id, RankService $service){
      
        $this->title = "edit rank";
        $this->edit = true;
        $this->rank = $service->getById($id);
        $this->name = $this->rank->name;
        $this->id = $this->rank->id;
       
    }

    public function delete($id,RankService $service){
        $service->delete($id);
    }

    public function render(RankService $service)
    {
        $ranks = $service->list($this->perpage, $this->search);
        return view('livewire.settings.rank', compact('ranks'))->layout('layouts.app');
    }
}
