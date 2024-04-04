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

    public $profile;
    public $omnibus;
    public $description;
    public $pvno;
    public $subhead_id;
    public $amount;
    public $title = "Add Omnibus";
    public $edittitle = "Edit Omnibus";
    public $addevent= "add-omnibus";
    public $editevent = "edit-omnibus";
    public $edit = false;
    public $search = '';

    public function search(OmnibusService $service){
        $omnibus = $service->list($this->search);
    }

    #[On('selectionChanged')]
    public function getSubheads($value,OmnibusService $service){
        dd($value);
    }

    public function save(OmnibusService $service)
    {
        $validate =  $this->validate([
            "subhead_id"       => ['required'],
            "amount"    => ['required'],
            "description"       => ['required'],
            "pvno"          => ['required'],
            "profile"            => ['nullable'],
            'account_id'      =>  ['required']
        ]);
       
        
        $response = $service->create($validate);

        $this->reset(['subhead_id','head_id','amount','description','profile','description','date_from','date_to','total']);

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
        $omnibusses = $omnibusService->list($this->search);
        return view('livewire.entries.ominbus',compact('omnibusses','heads'))->layout('layouts.app');
    }
}
