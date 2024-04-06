<?php

namespace App\Livewire;

use App\Services\PayrollService;
use App\Services\StaffprofileService;
use Faker\Provider\at_AT\Payment;
use Livewire\Component;

class StaffPayroll extends Component{
    
    public $month;
    public $data;
    public $year;
    public $option;
    public $records = [];
    public $count = 0;
   
    public $hide = true;

    public $options = ["create" => "Create Record","delete" => "Generate Record"];

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];
 
    public function search(PayrollService $payrollService, StaffprofileService $staffprofileService){

        $validated = $this->validate([ 
            'option' => 'nullable',
            'year' => 'required',
            'month' => 'required'
        ]);

        if(($validated['year']) && ($validated['month']) && !($validated['option'])){
           $this->records = $payrollService->getProfilePayroll($validated['month'],$validated['year'], 'staffprofile');
        }
        elseif(($validated['year']) && ($validated['month']) && ($validated['option'] == 'create')){
            $paygenerate =  $staffprofileService->createPayroll($validated['month'],$validated['year']);
            $payrollService->insertPayroll($validated['month'],$validated['year'],'staffprofile',$paygenerate);
           
            $this->records = $payrollService->getProfilePayroll($validated['month'],$validated['year'], 'staffprofile');
        }
        elseif(($validated['year']) && ($validated['month']) && ($validated['option'] == 'delete')){
            $delete = $payrollService->regeneratePayroll($validated['month'],$validated['year'],'staffprofile');

            $paygenerate = $staffprofileService->createPayroll($validated['month'], $validated['year']);

            $payrollService->insertPayroll($validated['month'], $validated['year'], 'staffprofile', $paygenerate);

            $this->records = $payrollService->getProfilePayroll($validated['month'],$validated['year'], 'staffprofile');
   
        }

        
    }

    public function render()
    {
        return view('livewire.payroll.staff-payroll')->layout('layouts.app');
    }
}
