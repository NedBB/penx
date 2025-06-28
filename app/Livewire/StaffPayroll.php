<?php

namespace App\Livewire;

use App\Services\PayrollService;
use App\Services\StaffprofileService;
use Faker\Provider\at_AT\Payment;
use Livewire\Component;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StaffPayrollExport;

class StaffPayroll extends Component{
    
    public $month;
    public $data;
    public $year;
    public $option;
    public $records = [];
    public $count = 0;
    public $salary = 0;
    public $rent = 0;
    public $utility = 0;
    public $entertainment = 0;
    public $contribution = 0;
    public $transport = 0;
    public $meal = 0;
    public $grosspay = 0;
    public $salaryadvance = 0;
    public $pension = 0;
    public $tax = 0;
    public $nhf = 0;
    public $deduction = 0;
    public $netpay = 0;
    public $loan = 0;
    public $editevent = "staff-payroll";
    public $detail;
    public $selectRow;
    public $fullname;
    public $show = false;
   
    public $hide = true;

    public $options = ["create" => "Create Record","delete" => "Generate Record"];

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    #[On('staff-payroll')]
    public function edit($id, PayrollService $payrollService){     
       $this->detail = $payrollService->getPersonPayroll($id,'staffprofile',$this->month, $this->year);
       
    }

    public function payslip($id,PayrollService $payrollService){
        $detail = $payrollService->getPersonPayroll($id,'staffprofile', $this->month, $this->year);
        
        // $this->detail = [
        //     'basicsalary' => $detail->basicsalary,
        //     'fullname' => $detail->profile->fullname(),
        //     'month' => $detail->month,
        //     'year' => $detail->year,
        //     'uniqueid' => $detail->profile->uniqueid
        // ];
        $words = $this->convertToWords($detail->netpay);
        $this->detail = $detail;
        $this->detail['words'] = $words;
        $this->show = true;
      
    }

    function convertToWords($number) {
        return numberToWords($number);
    }

    public function data(){
        
    }

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

    public function export(){
        return Excel::download(new StaffPayrollExport($this->records), 'staff-payroll.xlsx');
    }

    public function render()
    {
        return view('livewire.payroll.staff-payroll',['detail' => $this->detail])->layout('layouts.app');
    }
}
