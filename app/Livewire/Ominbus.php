<?php

namespace App\Livewire;

use App\Services\GroupheadService;
use App\Services\OmnibusService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Exports\OmnibusExport;
use Maatwebsite\Excel\Facades\Excel;

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
    public $head_id = 0;
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
    public $omnibusses = [];
    public $pvno_search;
    public $omnibusService;
    public $page_title = 'List of Omnibus Records';
    public $selected;
    public $selection = [];
    public $id;

    // public function boot(OmnibusService $omnibusService){
    //     $this->omnibusService = $omnibusService;
    // }

    public function selectData(){
        
    }

    public function searchrecords(OmnibusService $omnibusService){
        $this->omnibusses = $omnibusService->list($this->pvno_search);
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

    #[On('edit-omnibus')]
    public function edit($id, OmnibusService $omnibusservice, GroupheadService $groupheadService){
      
        $this->title = "edit omnibus";
        $this->edit = true;
        $this->omnibus = $omnibusservice->getById($id);
        $this->name = $this->omnibus->name;
        $this->amount = $this->omnibus->amount;
        $this->description = $this->omnibus->description;
        $this->subhead_id = $this->omnibus->subhead_id;
        $subhead = $groupheadService->getById($this->omnibus->subhead_id,'subhead');
        $this->head_id = $subhead->head_id;
    
        $this->date = sqldate($this->omnibus->created_at);
        $this->pvno = $this->omnibus->pvno;
        $this->id = $this->omnibus->id;
       
    }

    public function export(){
        return Excel::download(new OmnibusExport($this->omnibusses), 'omnibus.xlsx');
    }

    public function delete($id,OmnibusService $omnibusservice){
        $state =  $omnibusservice->delete($id);
        if($state){
            $records = $this->omnibusses;
            foreach ($records as $key => $record) {
                if ($record['id'] == $id) {
                    unset($records[$key]);
                }
            }
            $this->omnibusses = $records;
        }
    }

    public function render(GroupheadService $headService, OmnibusService $omnibusService)
    {
        $heads = $headService->headList();
        //$omnibusses = $omnibusService->list($this->search);
        //dd($omnibusses);
        //$omnibusses = $this->omnibusses;
        return view('livewire.entries.ominbus',compact('heads'))->layout('layouts.app');
    }
}
