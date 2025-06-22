<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\PayrollService;
use App\Services\NationalofficeService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OfficerPayrollExport;

class OfficerPayroll extends Component
{
    public $month;
    public $data;
    public $year;
    public $option;
    public $title="National Officers Payroll";
    public $page_title="";
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
 
    public function search(PayrollService $payrollService, NationalofficeService $nationalofficeService){

        $validated = $this->validate([ 
            'option' => 'nullable',
            'year' => 'required',
            'month' => 'required'
        ]);
       
        $this->page_title = "";
        $month = $this->monthrange[$this->month]." ".$this->year;
        $this->page_title = $this->title." for ".$month;

        if(($validated['year']) && ($validated['month']) && !($validated['option'])){
           $this->records = $payrollService->getProfilePayroll($validated['month'],$validated['year'], 'nationaloffice');
            //  dd($this->records);
        }
        elseif(($validated['year']) && ($validated['month']) && ($validated['option'] == 'create')){

            $paygenerate =  $nationalofficeService->payrollProfile($validated['month'],$validated['year']);
            $payrollService->insertPayroll($validated['month'],$validated['year'],'nationaloffice',$paygenerate);
            $this->records = $payrollService->getProfilePayroll($validated['month'],$validated['year'], 'nationaloffice');
        }
        elseif(($validated['year']) && ($validated['month']) && ($validated['option'] == 'delete')){

            $delete = $payrollService->regeneratePayroll($validated['month'],$validated['year'],'nationaloffice');
            $paygenerate =  $nationalofficeService->payrollProfile($validated['month'],$validated['year']);
            $payrollService->insertPayroll($validated['month'], $validated['year'], 'nationaloffice', $paygenerate);
            $this->records = $payrollService->getProfilePayroll($validated['month'],$validated['year'], 'nationaloffice');

        }

    }

    public function payslip($id,PayrollService $payrollService){
        $detail = $payrollService->getPersonPayroll($id,'nationalofficer', $this->month, $this->year);
        // $this->detail = [
        //     'basicsalary' => $detail->basicsalary,
        //     'fullname' => $detail->profile->fullname(),
        //     'month' => $detail->month,
        //     'year' => $detail->year,
        //     'uniqueid' => $detail->profile->uniqueid
        // ];
        $this->detail = $detail;
      
    }

    public function export(){
        return Excel::download(new OfficerPayrollExport($this->records), 'officer-payroll.xlsx');
    }

    public function render()
    {
        return view('livewire.payroll.officer-payroll')->layout('layouts.app');
    }
}
