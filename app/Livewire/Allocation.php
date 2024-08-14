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
