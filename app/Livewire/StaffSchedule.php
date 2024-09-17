<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\PayrollService;
use App\Services\StaffprofileService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StaffScheduleExport;

class StaffSchedule extends Component
{
    public $month;
    public $year;
    public $type;
    public $records = [];
    public $options = ["create" => "Create Record","delete" => "Generate Record"];

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    public $user_types = ["staffprofile" => "Staff Profile","nationaloffice" => "National Officer"];


    public function search(PayrollService $payrollService){

        $validated = $this->validate([ 
            'year' => 'required',
            'month' => 'required',
            'type' => 'required'
        ]);

        if(($validated['year']) && ($validated['month']) && $validated['type']){
           $this->records = $payrollService->getProfilePayroll($validated['month'],$validated['year'], $validated['type']);
          
        }
    }

    public function export(){
        return Excel::download(new StaffScheduleExport($this->records), 'staff-schedule.xlsx');
    }

    public function render()
    {
        return view('livewire.queries.staff-schedule')->layout('layouts.app');
    }
}
