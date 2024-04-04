<?php

namespace App\Livewire;

use App\Services\BankService;
use App\Services\DutystationService;
use App\Services\NationalofficeService;
use App\Services\PaymentmethodService;
use App\Services\TitleService;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class NationalStaff extends Component
{
    use WithPagination;

    public $officer;
    public $utility;
    public $entertainment;
    public $accountno;
    public $perpage = 5;
    public $surname;
    public $firstname;
    public $middlename;
    public $uniqueid;
    public $dutystation_id;
    public $title_id;
    public $bank_id;
    public $paymentmethod_id;
    public $honours;
    public $basicsalary;
    public $id;
    public $title = "Add Nation Office";
    public $edittitle = "Edit National Officer";
    public $addevent= "add-national-officer";
    public $editevent = "edit-national-officer";
    public $edit = false;
    public $search = '';
    public $titles, $dutystations, $banks, $payments;

    public function boot(TitleService $titleService, DutystationService $dutystationService,
    BankService $bankService, PaymentmethodService $paymentmethodService){
        $this->titles = $titleService->list();
        $this->dutystations = $dutystationService->list();
        $this->banks = $bankService->bankList();
        $this->payments = $paymentmethodService->list();
    }

    #[On('add-national-officer')]
    public function add(){
        $this->edit = false;
        $this->title = "Add National Officer";
        $this->reset(['basicsalary','title_id','paymentmethod_id','bank_id','accountno','dutystation_id',
        'honours','utility','uniqueid','surname','firstname','middlename','entertainment']);

    }

    public function update(NationalofficeService $service){
        $validate =  $this->validate([
            "dutystation_id"       => ['required'],
            "paymentmethod_id"    => ['required'],
            "title_id"    => ['required'],
            "bank_id"    => ['required'],
            "basicsalary"       => ['required'],
            "uniqueid"          => ['required'],
            "honours"            => ['required'],
            "entertainment"    => ['required'],
            "utility"    => ['required'],
            "accountno"    => ['required'],
            "surname"    => ['required'],
            "firstname"    => ['required'],
            "middlename"    => ['required'],
        ]);

        $response = $service->update($this->id,$validate);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-national-officer')]
    public function edit($id, NationalofficeService $service){
      
        $this->title = "edit national-officer";
        $this->edit = true;
        $this->officer = $service->getById($id);

        $this->id = $this->officer->id;
        $this->surname = $this->officer->surname;
        $this->firstname = $this->officer->firstname;
        $this->middlename = $this->officer->middlename;
        $this->uniqueid = $this->officer->uniqueid;
        $this->utility = $this->officer->utility;
        $this->entertainment = $this->officer->entertainment;
        $this->paymentmethod_id = $this->officer->paymentmethod_id;
        $this->bank_id = $this->officer->bank_id;
        $this->dutystation_id = $this->officer->dutystation_id;
        $this->title_id = $this->officer->title_id;
        $this->accountno = $this->officer->accountno;
        $this->basicsalary = $this->officer->basicsalary;
        $this->honours = $this->officer->honours;
       
    }


    public function save(NationalofficeService $service)
    {
        
        $validate =  $this->validate([
            "dutystation_id"       => ['required'],
            "paymentmethod_id"    => ['required'],
            "title_id"    => ['required'],
            "bank_id"    => ['required'],
            "basicsalary"       => ['required'],
            "uniqueid"          => ['required'],
            "honours"            => ['required'],
            "entertainment"    => ['required'],
            "utility"    => ['required'],
            "accountno"    => ['required'],
            "surname"    => ['required'],
            "firstname"    => ['required'],
            "middlename"    => ['required'],
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


    public function render(NationalofficeService $service)
    {
        $officers = $service->list($this->perpage, $this->search);
        return view('livewire.entries.national-office', compact('officers'))->layout('layouts.app');

    }

   
}
