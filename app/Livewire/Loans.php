<?php

namespace App\Livewire;

use App\Services\FixeddeductionService;
use App\Services\LoanService;
use App\Services\NationalofficeService;
use App\Services\StaffprofileService;
use Livewire\Component;
use Livewire\Attributes\On;
//use Spatie\LaravelPdf\Facades\Pdf;
use Barryvdh\DomPDF\Facade\Pdf;

class Loans extends Component
{
    public $title = "Add Loan";
    public $edittitle = "Edit Loan";
    public $addevent= "add-entry-loan";
    public $editevent = "edit-entry-loan";
    public $profile_option = "profile";
    public $profile_list = "profile_id";
    public $page_title = 'Loan Entries';
    public $payable;
    public $loan;
    public $interestrate;
    public $effect_month;
    public $monthly_due;
    public $expiry_month;
    public $period;
    public $id;
    public $loantypeService;
    public $loantype_id;
    public $profile;
    public $profile_id;
    public $record_id;
    public $principal;
    public $edit = false;
    public $profiledata = [];
    public $search = '';
    public $month_1;
    public $month_2;
    public $year_1;
    public $year_2;
    public $loans = [];
    public $loantypes;

    public $profileoption = ["staffprofile" => "staff",'nationalofficer' =>'national officer'];
    public $fixeddeductionService;

    // public function __construct(FixeddeductionService $fixeddeductionService){
    //     $this->fixeddeductionService = $fixeddeductionService;
    // }

    public function boot(LoanService $loanService){
        $this->loantypes = $loanService->getFulllist();
    }

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    #[On('add-entry-loan')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Loan";
        $this->reset(['monthly_due','period','principal','loantype_id',
        'expiry_month','effect_month','interestrate','payable','profile_id','profile']);

    }

    #[On('edit-entry-loan')]
    public function edit($id, FixeddeductionService $service){
      
        $this->title = "edit loan";
        $this->edit = true;
        $this->loan = $service->getById($id);
        
        $this->profile = $this->loan->profile_type;
        $this->profile_id = $this->loan->profile->fullname();
        
        $this->loantype_id = $this->loan->loantype_id;
        $this->payable = $this->loan->payableamount;
        $this->principal = $this->loan->principalamount;
        $this->monthly_due = $this->loan->monthlydue;
        $this->interestrate = $this->loantypes[($this->loan->loantype_id)-1]['interestrate'];;
        $this->effect_month = sqldate($this->loan->effectivedate);
        $this->expiry_month = $this->loan->expirydate;
        $this->period = $this->loan->period;
        $this->id = $this->loan->id;

        //dd($this->profile);
       
    }

    #[On('selectionChanged')]
    public function getProfile($value, StaffprofileService $staff, NationalofficeService $national){
        $records = ($value == 'staffprofile') ? $staff->getFulllist() : $national->getFulllist();
        $this->profiledata = $records;
        $this->profile = $value;
        $this->dispatch('messageSent', data:$records->toArray());
    }

    #[On('getInterest')]
    public function getInterest($value){
        $this->interestrate = $this->loantypes[$value-1]['interestrate'];
    }

    #[On('calculateLoanInterest')]
    public function calculateLoanInterest($value){
        $this->validate([ 
            'effect_month' => 'required',
            'principal' => 'required',
            'loantype_id' => 'required'
        ]);

        $start = icarbon($this->effect_month);
        $end = icarbon($this->expiry_month);
        $principal = ($this->principal) ?: 0;
        $interestrate = ($this->interestrate) ?: 0;
        $this->period = $start->diffInMonths($end, false);
        $this->payable = (($principal * $interestrate) + $principal);
        $this->monthly_due = ($this->payable / $this->period);
    }

    public function searchs(FixeddeductionService $fixeddeductionService){
        
        $validated = $this->validate([ 
            'year_1' => 'required',
            'year_2' => 'required',
            'month_1' => 'required',
            'month_2' => 'required'
        ]);
        
        $this->loans = $fixeddeductionService->getRecords($validated);
    }

    #[On('selectionSubhead')]
    public function getProfleId($value){
        $this->profile_id = $value;
    }

    public function save(FixeddeductionService $fixeddeductionService)
    {
        $validate =  $this->validate([
            "profile"       => ['required'],
            "profile_id"    => ['required'],
            "payable"       => ['required'],
            "interestrate"          => ['required'],
            "effect_month"          => ['required'],
            "expiry_month"            => ['required'],
            "loantype_id"  => ['required'],
            "principal"  => ['required'],
            "period"  => ['required'],
            "monthly_due"  => ['required']
        ]);

        $record = [
            'effectivedate' => $this->effect_month,
            'expirydate' => $this->expiry_month,
            'loandate' => sqldatetime(),
            'principalamount' => $this->principal,
            'period' => $this->period,
            'loantype_id' => $this->loantype_id,
            'payableamount' => $this->payable,
            'monthlydue' =>$this->monthly_due,
            'profile_type'=>$this->profile,
            'profile_id'=>$this->profile_id
        ];

        $response = $fixeddeductionService->create($record);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
        

        $this->reset(['monthly_due','period','principal','loantype_id',
                    'expiry_month','effect_month','interestrate','payable','profile_id','profile']);
        
      }

    public function delete($id,FixeddeductionService $service){
        $state = $service->delete($id);
        if($state){
            $records = $this->loans;
            foreach ($records as $key => $record) {
                if ($record['id'] == $id) {
                    unset($records[$key]);
                }
            }
            $this->loans = $records;
        }
    }

    public function exportPdf(){
        $pdf = Pdf::loadView('livewire.pdfs.loan-pdf',["loans" => $this->loans,'page_title' => $this->page_title]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
            }, 'loan.pdf');
    }

    public function update(FixeddeductionService $service){

        $validate =  $this->validate([
            "profile"       => ['required'],
            "profile_id"    => ['required'],
            "payable"       => ['required'],
            "interestrate"          => ['required'],
            "effect_month"          => ['required'],
            "expiry_month"            => ['required'],
            "loantype_id"  => ['required'],
            "principal"  => ['required'],
            "period"  => ['required'],
            "monthly_due"  => ['required']
        ]);

        $response = $service->update($this->id,$validate);

        
        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function render()
    {
        return view('livewire.entries.loans')->layout('layouts.app');
    }
}
