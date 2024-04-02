<?php

namespace App\Livewire;

use App\Services\ConpossService;
use App\Services\GradelevelService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Conposs extends Component
{
    use WithPagination;

    public $baseamount; 
    public $step;
    public $gradelevel_id;
    public $incrementrate;
    public $id;
    public $conposs;
    public $gradelevel;
    public $title = "Add Conposs";
    public $edittitle = "Edit Conposs";
    public $addevent= "add-conposs";
    public $editevent = "edit-conposs";
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-conposs')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Conposs";
        $this->reset(['gradelevel_id','incrementrate','baseamount','step']);
    }

    public function boot(GradelevelService $service){
        $this->gradelevel = $service->list();
    }

    public function save(ConpossService $service){

        $validated = $this->validate([ 
            'gradelevel_id' => 'required|numeric|min:3',
            'incrementrate' => 'required|numeric|min:3',
            'step' => 'required|numeric|min:3',
            'baseamount' => 'required|numeric|min:3'
        ]);

        $response = $service->create($validated);

        $this->reset(['gradelevel_id','incrementrate','baseamount','step']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(ConpossService $service){
        $validated = $this->validate([ 
            'gradelevel_id' => 'required|numeric|min:3',
            'incrementrate' => 'required|numeric|min:3',
            'step' => 'required|numeric|min:3',
            'baseamount' => 'required|numeric|min:3'
        ]);

        $response = $service->update($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-conposs')]
    public function edit($id, ConpossService $service){
      
        $this->title = "edit conposs";
        $this->edit = true;
        $this->conposs = $service->getById($id);
        $this->step = $this->conposs->step;
        $this->gradelevel_id = $this->conposs->gradelevel_id;
        $this->incrementrate = $this->conposs->incrementrate;
        $this->baseamount = $this->conposs->baseamount;
        $this->id = $this->conposs->id;
       
    }

    public function delete($id,ConpossService $service){
        $service->delete($id);
    }

    public function render(ConpossService $service)
    {
        $conposses = $service->list($this->perpage, $this->search);
        return view('livewire.settings.conposs',compact('conposses'))->layout('layouts.app');
    }
}
