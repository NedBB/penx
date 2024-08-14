<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\GroupheadService;
use App\Services\OmnibusService;
use App\Services\TransportandtravelService;
use Livewire\Attributes\On;
use App\Exports\TandTExport;
use App\Services\StaffprofileService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class TandT extends Component
{
    use WithPagination;
    public $name;
    public $ttrecords;
    public $tts = [];
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
    public $title = "Add Transport and Travel";
    public $edittitle = "Edit Transport and Travel";
    public $addevent= "add-transport";
    public $editevent = "edit-tt";
    public $edit = false;
    public $search = '';
    public $pvno_search;
    public $page_title = 'List of Transport and Travel Records';
    public $selected;
    public $selection = [];

    public $id;
    public $transport;
    public $house = 0;
    public $seating = 0; 
    public $outstation = 0; 
    public $food = 0;
    public $house_multiple = 0;
    public $seating_multiple = 0; 
    public $outstation_multiple = 0; 
    public $food_multiple = 0;
    public $house_total;
    public $seating_total; 
    public $outstation_total; 
    public $food_total;
    public $grand_total;
    public $date_record;

   

    public function calculateTotals(){
        $this->house_total = $this->house_multiple * $this->house;
        $this->food_total = $this->food_multiple * $this->food;
        $this->outstation_total = $this->outstation_multiple * $this->outstation;
        $this->seating_total = $this->seating_multiple * $this->seating;
        $this->grand_total = $this->transport + $this->house_total + $this->food_total + $this->outstation_total + $this->seating_total;
    }

    public function searchrecords(TransportandtravelService $transport){
        $this->tts = $transport->getByPvno($this->pvno_search);
        
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

    public function save(TransportandtravelService $transport)
    {
        $validate =  $this->validate([
            "subhead_id"       => ['required'],
            "transport"    => ['required'],
            "description"       => ['required'],
            "pvno"          => ['required'],
            "name"            => ['nullable'],
        ]);

        $validate['food'] = $this->food;
        $validate['food_multiple'] = $this->food_multiple;
        $validate['seating_multiple'] = $this->seating_multiple;
        $validate['seating'] = $this->seating;
        $validate['outstation'] = $this->outstation;
        $validate['outstation_multiple'] = $this->outstation_multiple;
        $validate['house'] = $this->house;
        $validate['house_multiple'] = $this->house_multiple;
        $validate['grand_total'] = $this->grand_total;

        $response = $transport->createRecord($validate);

        $this->reset(['transport','head_id','pvno','description','name','description','date']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    #[On('edit-tt')]
    public function edit($id, TransportandtravelService $transport, GroupheadService $groupheadService){
      
        $this->title = "edit transport and travel";
        $this->edit = true;
        $this->ttrecords = $transport->getRecordById($id);
        $this->name = $this->ttrecords->profile;
        $this->description = $this->ttrecords->description;
        $this->subhead_id = $this->ttrecords->subhead_id;
        $subhead = $groupheadService->getById($this->ttrecords->subhead_id,'subhead');
        $this->head_id = $subhead->head_id;
    
        $this->date = sqldate($this->ttrecords->created_at);
        $this->pvno = $this->ttrecords->pvno;
        $this->id = $this->ttrecords->id;
        $this->transport = $this->ttrecords->transportallowance;
        $this->outstation = $this->ttrecords->outstationallowance;
        $this->outstation_multiple = $this->ttrecords->os_multiple;
        $this->food = $this->ttrecords->foodallowance;
        $this->food_multiple = $this->ttrecords->fa_multiple;
        $this->house = $this->ttrecords->houseallowance;
        $this->house_multiple = $this->ttrecords->ha_multiple;
        $this->seating_multiple = $this->ttrecords->sa_multiple;
        $this->seating = $this->ttrecords->sittingallowance;
        $this->grand_total = $this->ttrecords->totalamount;

        $this->food_total = $this->food * $this->food_multiple;
        $this->seating_total = $this->seating * $this->seating_multiple;
        $this->house_total = $this->house * $this->house_multiple;
        $this->outstation_total = $this->outstation * $this->outstation_multiple;
       
    }

    public function export(){
        return Excel::download(new TandTExport($this->tts), 'tandt.xlsx');
    }

    public function render(GroupheadService $headService, StaffprofileService $staffprofileService)
    {
        $heads = $headService->headList();
        $this->date_record = Carbon::now()->toDateString();
        $fullnames = $staffprofileService->getNameAndId();
        return view('livewire.entries.tand-t', compact('heads','fullnames'))->layout('layouts.app');
    }
}
