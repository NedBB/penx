<?php

namespace App\Livewire;

use Livewire\Component;

use App\Services\AllocationService;
use App\Services\StaffprofileService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExpenseExport;
use App\Services\OmnibusService;
use App\Services\TransportandtravelService;

class QueryExpense extends Component
{

    public $start_date;
    public $end_date;
    public $types = "Expense Schedule";
    public $type;
    public $records = [];
    public $options = ["create" => "Create Record","delete" => "Generate Record"];

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    public $user_types = ["tandt" => "Transport and Travel","allocation" => "Allocation","omnibus"=>"Omnibus"];


    public function search(AllocationService $allocationService, OmnibusService $omnibusService, TransportandtravelService $tandtService){

        $validated = $this->validate([ 
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required'
        ]);

        if(($validated['start_date']) && ($validated['end_date']) && $validated['type'] == "allocation"){
           $this->records = $allocationService->getAllocationByDateRange($validated['start_date'],$validated['end_date']);
           $this->types = $this->user_types[$validated['type']];
           
        }
        else if(($validated['start_date']) && ($validated['end_date']) && $validated['type'] == "tandt"){
            
            $this->records = $tandtService->getTantByDateRange($validated['start_date'],$validated['end_date']);
            $this->types = $this->user_types[$validated['type']];
           
        }
        else if(($validated['start_date']) && ($validated['end_date']) && $validated['type'] == "omnibus"){
            $this->records = $omnibusService->getOmnibusByDateRange($validated['start_date'],$validated['end_date']);
            $this->types = $this->user_types[$validated['type']];
            
         }
    }

    public function export(){
        return Excel::download(new ExpenseExport($this->records), 'expense-schedule.xlsx');
    }

    public function render()
    {
        return view('livewire.queries.query-expense')->layout('layouts.app');
    }
}
