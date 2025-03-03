<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\OmnibusService;
use App\Services\AllocationService;
use App\Services\GroupheadService;
use App\Services\TransportandtravelService;
use Carbon\Carbon;


class EditExpenditure extends Component
{

    public $tandtService;
    public $omnibusService;
    public $allocationService;
    public $records;
    public $old_subhead_id;
    public $id;
    public $response;
    public $title = "Edit Records Subhead";
    public $subheads = [];
    public $editevent ="Update Subhead";
    public $subhead_id;
    public $record;
    public $results;
    public $year;
    public $addevent= "edit-expenditures";
    public $head_id;
    public $show = false;
    public $record_type = ["omnibus" =>"Omnibus","allocation"=>"Allocation","tandt"=>"Transport and Travel"];
    protected $listeners = [
        'refreshOmnibusRecords' => 'search'
    ];

    #[On('selectionChanged')]
    public function getSubheads($value,GroupheadService $service){
        $this->head_id = $value;
        $records = $service->getSubHeadByHeadid($value);
        $this->subheads = $records;
        $this->dispatch('messageSent', data:$records);
    }

    #[On('selectionSubhead')]
    public function updateSubhead($value){

        if(isset($old_subhead_id)){
            $this->subhead_id = $value;
            $this->old_subhead_id = $value;
        }else{
            $this->subhead_id = $value;
        }
        
    }

    public function update(OmnibusService $omnibusService, AllocationService $allocationService, TransportandtravelService $transportandtravelService){
        
        switch ($this->record) {
            case "omnibus":
                $this->response = $omnibusService->updateSubhead($this->id, $this->subhead_id);
                break;
            case "allocation":
                $this->response = $allocationService->updateSubhead($this->id, $this->subhead_id);
                break;
            case "tandt":
                $this->response = $transportandtravelService->updateSubhead($this->id, $this->subhead_id);
                break;
            default:
                break;
        }

        if($this->response){
            $this->dispatch('refreshOmnibusRecords');

            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }

    }

    public function openModal($value){
        $this->id = $value;
    }

    public function search(OmnibusService $omnibusService, AllocationService $allocationService, TransportandtravelService $transportandtravelService){
        $this->show = true;

        $startOfYear = Carbon::create($this->year, 1, 1, 0, 0, 0); 
        $endOfYear = Carbon::create($this->year, 12, 31, 23, 59, 59);
       

        $subhead_id =  $this->old_subhead_id;
        //dd($subhead_id);
        switch ($this->record) {
            case "omnibus":
                $this->results = $omnibusService->getRecordWithUnknownSubhead($startOfYear,$endOfYear, $subhead_id);
                break;
            case "allocation":
                $this->results = $allocationService->getRecordWithUnknownSubhead($startOfYear,$endOfYear, $subhead_id);
                break;
            case "tandt":
                $this->results = $transportandtravelService->getRecordWithUnknownSubhead($startOfYear,$endOfYear, $subhead_id);
                break;
            default:
                break;
        }
    }


    public function render(GroupheadService $groupheadService)
    {
        $heads = $groupheadService->headList();
        
        return view('livewire.ledgers.edit-expenditure',compact('heads'))->layout('layouts.app');;
    }
}
