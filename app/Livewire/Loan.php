<?php

namespace App\Livewire;

use App\Services\LoanService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Loan extends Component
{
    use WithPagination;

    public $name; 
    public $id;
    public $loan;
    public $title = "Add Loan";
    public $edittitle = "Edit Loan";
    public $addevent= "add-loan";
    public $editevent = "edit-loan";
    public $edit = false;
    public $search = '';
    public $perpage = 5;
    public $interestrate;

    #[On('add-loan')]
    public function add(){
        $this->edit = false;
        $this->title = "Add Loan";
        $this->reset(['name','interestrate']);
    }

    public function save(LoanService $service){

        $validated = $this->validate([ 
            'name' => 'required|min:3',
            'interestrate' => 'required|numeric'
        ]);

        $response = $service->create($validated);

        $this->reset(['name','interestrate']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(LoanService $service){
        $validated = $this->validate([ 
            'name' => 'required|min:3',
            'interestrate' => 'required|min:1'
        ]);

        $response = $service->update($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-loan')]
    public function edit($id, LoanService $service){
        $this->title = "edit loan";
        $this->edit = true;
        $this->loan = $service->getById($id);
        $this->name = $this->loan->name;
        $this->interestrate = $this->loan->interestrate;
        $this->id = $this->loan->id; 
    }

    public function delete($id,LoanService $service){
        $service->delete($id);
    }


    public function render(LoanService $service)
    {
        $loans = $service->list($this->perpage, $this->search);
        return view('livewire.settings.loan',compact('loans'))->layout('layouts.app');
    }
}
