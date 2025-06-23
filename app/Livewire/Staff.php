<?php

namespace App\Livewire;

use App\Services\StaffprofileService;
use App\Services\TitleService;
use App\Services\BankService;
use App\Services\PaymentmethodService;
use App\Services\DutystationService;
use App\Services\GradelevelService;
use App\Services\ConpossService;
use App\Services\DepartmentService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\StaffprofileExport;
use Maatwebsite\Excel\Facades\Excel;

class Staff extends Component
{
    use WithPagination;

  
    public $utility;
    public $entertainment;
    public $accountno;
    public $status;
    public $perpage = 5;
    public $surname;
    public $firstname;
    public $middlename;
    public $uniqueid;
    public $dutystation_id;
    public $title_id;
    public $bank_id;
    public $step_id;
    public $gradelevel_id;
    public $paymentmethod_id;
    public $honours;
    public $baseamount;
    public $gradelevels;
    public $conposses;
    public $id;
    public $title = "Add Staff";
    public $edittitle = "Edit Staff";
    public $addevent= "add-staff";
    public $editevent = "edit-staff";
    public $edit = false;
    public $page_title = "Staff Profile";
    public $staffdetail;
    public $tax;
    public $partofpension;
    public $partofnhf;
    public $pensionpin;
    public $contribution;
    public $taxpin;
    public $department_id;
    public $departments;
    public $steps;
    public $step;
    
    public $nhfpin;
    public $search = '';
    public $titles, $dutystations, $banks, $payments;

    public function boot(TitleService $titleService, DutystationService $dutystationService,
    BankService $bankService, PaymentmethodService $paymentmethodService, 
    GradelevelService $gradelevelService, ConpossService $conpossService, 
    DepartmentService $departmentService){
        $this->titles = $titleService->list();
        $this->dutystations = $dutystationService->list();
        $this->banks = $bankService->bankList();
        $this->payments = $paymentmethodService->list();
        $this->gradelevels = $gradelevelService->list();
        $this->conposses = $conpossService->getList();
        $this->departments = $departmentService->getList();
        $this->steps = $gradelevelService->listSteps();
    }

    #[On('add-staff')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Staff";
        $this->reset(['baseamount','title_id','paymentmethod_id','bank_id','accountno','dutystation_id',
        'department_id','utility','uniqueid','surname','firstname','middlename','entertainment','contribution']);

    }

    public function update(StaffprofileService $service, ConpossService $conposses){
        $validate =  $this->validate([
            "dutystation_id"       => ['required'],
            "paymentmethod_id"    => ['required'],
            "title_id"    => ['required'],
            "bank_id"    => ['required'],
            "step" => ['required'],
            "uniqueid"          => ['required'],
            "gradelevel_id" => ['required'],
            "department_id"            => ['required'],
            "entertainment"    => ['required'],
            "utility"    => ['required'],
            "accountno"    => ['required'],
            "surname"    => ['required'],
            "firstname"    => ['required'],
            "middlename"    => ['nullable'],
            "partofpension" => ['nullable'],
            "partofnhf" => ['nullable'],
            "pensionpin" => ['nullable'],
            "taxpin" => ['nullable'],
            "nhfpin" => ['nullable'],
            "status" => ['nullable']
        ]);

        $validate['conposs_id'] = $conposses->getConpossWithStep($validate['step'], $validate['gradelevel_id']);

        $response = $service->update($this->id,$validate);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-staff')]
    public function edit($id, StaffprofileService $service){
      
        $this->title = "edit staff";
        $this->edit = true;
        $this->staffdetail = $service->getById($id);

        $this->id = $this->staffdetail->id;
        $this->gradelevel_id = $this->staffdetail->gradelevel_id;
        $this->surname = $this->staffdetail->surname;
        $this->firstname = $this->staffdetail->firstname;
        $this->middlename = $this->staffdetail->middlename;
        $this->uniqueid = $this->staffdetail->uniqueid;
        $this->utility = $this->staffdetail->utility;
        $this->entertainment = $this->staffdetail->entertainment;
        $this->paymentmethod_id = $this->staffdetail->paymentmethod_id;
        $this->bank_id = $this->staffdetail->bank_id;
        $this->dutystation_id = $this->staffdetail->dutystation_id;
        $this->title_id = $this->staffdetail->title_id;
        $this->accountno = $this->staffdetail->accountno;
        $this->baseamount = ($this->staffdetail->conposs->baseamount)/12;
        $this->honours = $this->staffdetail->honours;
       
    }

    public function export(StaffprofileService $service){
        $staff = $service->getFulllist();
        return Excel::download(new StaffprofileExport($staff), 'staffprofile.xlsx');
    }

    public function save(StaffprofileService $service)
    {
        
        $validate =  $this->validate([
            "dutystation_id"       => ['required'],
            "paymentmethod_id"    => ['required'],
            "title_id"    => ['required'],
            "bank_id"    => ['required'],
            "step" => ['required'],
            "baseamount"       => ['required'],
            "uniqueid"          => ['required'],
            "department_id"            => ['required'],
            "entertainment"    => ['required'],
            "utility"    => ['required'],
            "accountno"    => ['required'],
            "surname"    => ['required'],
            "firstname"    => ['required'],
            "middlename"    => ['nullable'],
            "partofpension" => ['nullable'],
            "partofnhf" => ['nullable'],
            "pensionpin" => ['nullable'],
            "taxpin" => ['nullable'],
            "nhfpin" => ['nullable']
        ]);

        $response = $service->create($validate);

        $this->reset(['basicsalary','title_id','paymentmethod_id','bank_id','accountno','dutystation_id',
        'honours','utility','uniqueid','surname','firstname','middlename','entertainment']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function render(StaffprofileService $service)
    {
        $staff = $service->list($this->search);
        
        return view('livewire.entries.staff',compact('staff'))->layout('layouts.app');
    }
}
