<?php

namespace App\Livewire;

use App\Services\BankService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Bank extends Component
{
    use WithPagination;

    public $name; 
    public $id;
    public $bank;
    public $title = "Add Bank";
    public $edittitle = "Edit Bank";
    public $addevent= "add-bank";
    public $editevent = "edit-bank";
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-bank')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Bank";
        $this->reset(['name']);
    }

    public function save(BankService $service){

        $validated = $this->validate([ 
            'name' => 'required|min:3'
        ]);

        $response = $service->create($validated);

        $this->reset(['name']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(BankService $service){
        $validated = $this->validate([ 
            'name' => 'required|min:3'
        ]);

        $response = $service->update($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-bank')]
    public function edit($id, BankService $service){
        $this->title = "edit bank";
        $this->edit = true;
        $this->bank = $service->getById($id);
        $this->name = $this->bank->name;
        $this->id = $this->bank->id; 
    }

    public function delete($id,BankService $service){
        $service->delete($id);
    }

    public function render(BankService $service)
    {
        $banks = $service->bankList($this->perpage, $this->search);
        return view('livewire.settings.bank',compact('banks'))->layout('layouts.app');
    }
}
