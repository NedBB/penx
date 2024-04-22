<?php

namespace App\Livewire;

use App\Services\ContractorService;
use App\Services\ContractService;
use Livewire\Attributes\On;
use Livewire\Component;

class Contract extends Component
{
    public $title = "Add Contract";
    public $edittitle = "Edit Contract";
    public $addevent= "add-contract";
    public $editevent = "edit-contract";
    public $edit = false;
    public $contract;
    public $id;
    public $payment;
    public $company_name;
    public $contract_title;
    public $contractor;
    public $description;
    public $start_date;
    public $expected_delivery_date;
    public $cost;
    public $payment_date;

    #[On('add-contract')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Comtract";
        $this->reset(['contractor','company_name','expected_delivery_date','description',
                    'payment_date','payment','contract_title','cost','start_date']);

    }

    #[On('edit-contract')]
    public function edit($id, ContractService $contractService){
      
        $this->title = "edit contract";
        $this->edit = true;
        $this->contract = $contractService->getById($id);
        $contractpayment = $contractService->getContractPayment($id);
        $this->contractor = $this->contract->contractor_id;
        $this->company_name = $this->contract->company_name;
        $this->expected_delivery_date = $this->contract->expected_end_at;
        $this->description = $this->contract->description;
        $this->start_date = $this->contract->start_at;
        $this->contract_title = $this->contract->title;
        $this->cost = $this->contract->cost;
        $this->payment = $contractpayment->paid_amount;
        $this->payment_date = $contractpayment->paid_date;
        $this->id = $this->contract->id;
      
    }

    public function save(ContractService $contractService)
    {
        $validate =  $this->validate([
            "contractor"       => ['required'],
            "company_name"    => ['nullable'],
            "contract_title"       => ['required'],
            "cost"          => ['required'],
            "payment"          => ['required'],
            "payment_date"            => ['required'],
            "start_date"  => ['required'],
            "expected_delivery_date"  => ['required'],
            "description"  => ['required'],
        ]);

        $response = $contractService->create($validate);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
        
        $this->reset(['contractor','company_name','expected_delivery_date','description',
                    'payment_date','payment','title','cost','start_date']);
        
    }

    public function update($id, ContractService $contractorService){

        $validate =  $this->validate([
            "contractor"       => ['required'],
            "company_name"    => ['nullable'],
            "contract_title"       => ['required'],
            "cost"          => ['required'],
            "payment"          => ['required'],
            "payment_date"            => ['required'],
            "start_date"  => ['required'],
            "expected_delivery_date"  => ['required'],
            "description"  => ['required'],
        ]);

        $response = $contractorService->update($id, $validate);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }

        $this->reset(['contractor','company_name','expected_delivery_date','description',
                    'payment_date','payment','title','cost','start_date']);
    }

    public function delete($id,ContractService $contractorService){
        $contractorService->delete($id);
    }

    public function render(ContractService $contractService, ContractorService $contractorService)
    {
        $contracts = $contractService->getRecords();
        $contractors = $contractorService->getAll();
     
        return view('livewire.entries.contract',compact('contracts','contractors'))->layout('layouts.app');
    }
}
