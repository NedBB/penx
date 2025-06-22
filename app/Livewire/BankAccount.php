<?php

namespace App\Livewire;

use App\Services\BankService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class BankAccount extends Component
{
    use WithPagination;
    
    public $name; 
    public $id;
    public $bankaccount;
    public $title = "Add Bank Account";
    public $edittitle = "Edit Bank Account";
    public $addevent= "add-bank-account";
    public $editevent = "edit-bank-account";
    public $bank_id;
    public $account_number;
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-bank-account')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Bank Account";
        $this->reset(['name','bank_id','account_number']);
    }

    public function save(BankService $service){

        $validated = $this->validate([ 
            'name' => 'required|min:3',
            'bank_id' => 'required|numeric',
            'account_number' => 'required|numeric'
        ]);

        $response = $service->createAccount($validated);

        $this->reset(['name','bank_id','account_number']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(BankService $service){
        $validated = $this->validate([ 
            'name' => 'required|min:3',
            'bank_id' => 'required|numeric',
            'account_number' => 'required|numeric'
        ]);

        $response = $service->updateAccount($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-bank-account')]
    public function edit($id, BankService $service){
      
        $this->title = "edit bank account";
        $this->edit = true;
        $this->bankaccount = $service->getAccountById($id);
        $this->name = $this->bankaccount->name;
        $this->account_number = $this->bankaccount->account_number;
        $this->bank_id = $this->bankaccount->bank_id;
        $this->id = $this->bankaccount->id;
    }

    public function delete($id,BankService $service){
        $service->deleteAccount($id);
    }

    
    public function render(BankService $service)
    {
        $banks = $service->bankList();
        $accounts = $service->accountList($this->perpage, $this->search);
        return view('livewire.settings.bank-account', compact('accounts','banks'))->layout('layouts.app');
    }
}
