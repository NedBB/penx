<?php

namespace App\Livewire;

use App\Services\BankService;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Services\ContractorService;
use App\Services\TitleService;
use Livewire\WithPagination;

class Contractor extends Component
{
    use WithPagination;

    public $baseamount; 
    public $step;
    public $firstname;
    public $surname;
    public $number;
    public $title_id;
    public $titles;
    public $banks;
    public $bank_id;
    public $account_no;
    public $account_name;
    public $address;
    public $id;
    public $contractor;
    public $gradelevel;
    public $title = "Add Contractor";
    public $edittitle = "Edit Contractor";
    public $addevent= "add-contractor";
    public $editevent = "edit-contractor";
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-contractor')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Contractor";
        $this->reset(['surname','firstname','account_no',
        'account_name','title_id','bank_id','number','address']);
    }

    public function boot(TitleService $titleService,BankService $bankService){
        $this->titles = $titleService->list();
        $this->banks = $bankService->bankList();
    }

    public function save(ContractorService $service){

        $validated = $this->validate([ 
            'title_id' => 'required|numeric|min:3',
            'bank_id' => 'required|numeric|min:3',
            'number' => 'required|min:3',
            'surname' => 'required|min:3',
            'firstname' => 'required|numeric|min:3',
            'account_no' => 'required|min:3',
            'account_name' => 'required|min:3',
            'address' => 'required|min:3'
        ]);

        $response = $service->create($validated);

        $this->reset(['surname','firstname','account_no',
        'account_name','title_id','bank_id','number','address']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(ContractorService $service){

        $validated = $this->validate([ 
            'title_id' => 'required|numeric|min:3',
            'bank_id' => 'required|numeric|min:3',
            'number' => 'required|min:3',
            'surname' => 'required|min:3',
            'firstname' => 'required|numeric|min:3',
            'account_no' => 'required|min:3',
            'account_name' => 'required|min:3',
            'address' => 'required|min:3'
        ]);

        $response = $service->update($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-contractor')]
    public function edit($id, ContractorService $service){
      
        $this->title = "edit contractor";
        $this->edit = true;
        $this->contractor = $service->getById($id);
        $this->firstname = $this->contractor->firstname;
        $this->surname = $this->contractor->surname;
        $this->number = $this->contractor->number;
        $this->account_name = $this->contractor->account_name;
        $this->account_no = $this->contractor->account_no;
        $this->address = $this->contractor->address;
        $this->bank_id = $this->contractor->bank_id;
        $this->title_id = $this->contractor->title_id;
        $this->id = $this->conposs->id;
       
    }

    public function delete($id,ContractorService $service){
        $service->delete($id);
    }


    public function render(ContractorService $service)
    {
        $contractors = $service->list($this->perpage, $this->search);
   
        return view('livewire.settings.contractor', compact('contractors'))->layout('layouts.app');
    }
}
