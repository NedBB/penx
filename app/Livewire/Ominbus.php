<?php

namespace App\Livewire;

use App\Services\GroupheadService;
use App\Services\OmnibusService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Ominbus extends Component
{
    use WithPagination;

    public $name;
    public $omnibus;
    public $page = 5;
    public $description;
    public $subheads = [];
    public $pvno;
    public $subhead_id;
    public $head_id;
    public $date;
    public $head_field ="head_id";
    public $subhead_field = "subhead_id";
    public $amount;
    public $title = "Add Omnibus";
    public $edittitle = "Edit Omnibus";
    public $addevent= "add-omnibus";
    public $editevent = "edit-omnibus";
    public $edit = false;
    public $search = '';

    public function search(OmnibusService $service){
        $omnibus = $service->list($this->page,$this->search);
    }

    #[On('selectionChanged')]
    public function getSubheads($value,GroupheadService $service){
        $records = $service->getSubHeadByHeadid($value);
        $this->dispatch('messageSent', data:$records);
    }

    #[On('selectionSubhead')]
    public function updateSubhead($value){
        $this->subhead_id = $value;
    }


    public function save(OmnibusService $service)
    {
        $validate =  $this->validate([
            "subhead_id"       => ['required'],
            "amount"    => ['required'],
            "description"       => ['required'],
            "pvno"          => ['required'],
            "name"            => ['nullable']
        ]);

        $response = $service->create($validate);

        $this->reset(['amount','head_id','pvno','description','name','description','date']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function render(GroupheadService $headService, OmnibusService $omnibusService)
    {
        $heads = $headService->headList();
        $omnibusses = $omnibusService->list($this->page,$this->search);
        return view('livewire.entries.ominbus',compact('omnibusses','heads'))->layout('layouts.app');
    }
}
