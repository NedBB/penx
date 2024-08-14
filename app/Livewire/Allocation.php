<?php

namespace App\Livewire;

use App\Services\AllocationService;
use App\Services\GroupheadService;
use App\Services\LocationService;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\OmnibusService;
use App\Services\TransportandtravelService;
use Livewire\Attributes\On;
use App\Exports\AllocationExport;
use App\Services\StaffprofileService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class Allocation extends Component
{
    use WithPagination;
    public $allocations = [];
    public $pvno_search;
    public $heads;
    public $locations;
    public $location_id;
    
    public $name;
    public $allocation;
    public $tts = [];
    public $page = 5;
    public $subheads = [];
    public $pvno;
    public $subhead_id;
    public $head_id = 0;
    public $date;
    public $head_field ="head_id";
    public $subhead_field = "subhead_id";
    public $net_pay = 0;
    public $gross_pay = 0;
    public $constitution = 0;
    public $arrears = 0;
    public $nlc = 0;
    public $allocation_field = 0;
    public $divisionpercent = false;
    public $applypercent = false;
    public $legal = 0;
    public $almanac = 0;
    public $advance_allocation = 0;
    public $audit_fees = 0;
    public $badges = 0;
    public $northern_dues = 0;
    public $amount;
    public $title = "Add Allocations";
    public $edittitle = "Edit Allocations";
    public $addevent= "add-allocations";
    public $editevent = "edit-allocation";
    public $edit = false;
    public $search = '';
    public $page_title = 'List of Allocations';
    public $selected;
    public $selection = [];
    public $subhead_field_lists;
    public $subhead_search_field;
    public $month_1;
    public $month_2;
    public $year_1;
    public $year_2;

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    public function boot(GroupheadService $head, LocationService $locations, GroupheadService $headService){
        $this->heads = $head->headList();
        $this->subhead_field_lists = $headService->getSubHeadByHeadid(1);
        $this->locations = $locations->listState();
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

    #[On('edit-allocation')]
    public function edit($id, AllocationService $allocationService, GroupheadService $groupheadService){
      
        $this->title = "edit transport and travel";
        $this->edit = true;
        // $this->allocation = $allocationService->getRecordById($id);
        // $this->name = $this->ttrecords->profile;
        // $this->description = $this->ttrecords->description;
        // $this->subhead_id = $this->ttrecords->subhead_id;
        // $subhead = $groupheadService->getById($this->ttrecords->subhead_id,'subhead');
        // $this->head_id = $subhead->head_id;
    
        // $this->date = sqldate($this->ttrecords->created_at);
        // $this->pvno = $this->ttrecords->pvno;
        // $this->id = $this->ttrecords->id;
        // $this->transport = $this->ttrecords->transportallowance;
        // $this->outstation = $this->ttrecords->outstationallowance;
        // $this->outstation_multiple = $this->ttrecords->os_multiple;
        // $this->food = $this->ttrecords->foodallowance;
        // $this->food_multiple = $this->ttrecords->fa_multiple;
        // $this->house = $this->ttrecords->houseallowance;
        // $this->house_multiple = $this->ttrecords->ha_multiple;
        // $this->seating_multiple = $this->ttrecords->sa_multiple;
        // $this->seating = $this->ttrecords->sittingallowance;
        // $this->grand_total = $this->ttrecords->totalamount;

        // $this->food_total = $this->food * $this->food_multiple;
        // $this->seating_total = $this->seating * $this->seating_multiple;
        // $this->house_total = $this->house * $this->house_multiple;
        // $this->outstation_total = $this->outstation * $this->outstation_multiple;
       
    }

    public function searchs(AllocationService $allocationsService){
        
        $validated = $this->validate([ 
            'subhead_search_field' => 'required',
            'year_1' => 'required',
            'year_2' => 'required',
            'month_1' => 'required',
            'month_2' => 'required'
        ]);
       
        $this->allocations = $allocationsService->getRecords($validated);
    }

    public function searchrecords(AllocationService $allocationsService){
        $this->allocations = $allocationsService->getRecordsByPvno($this->pvno_search);
    }

    public function export(){
        return Excel::download(new AllocationExport($this->allocations), 'allocation.xlsx');
    }

    public function render(AllocationService $allocationService)
    {
        return view('livewire.entries.allocation')->layout('layouts.app');
    }
}
