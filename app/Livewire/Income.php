<?php

namespace App\Livewire;

use App\Services\BankService;
use App\Services\IncomeService;
use App\Services\LocationService;
use Livewire\Component;

class Income extends Component
{
    public $date_from;
    public $date_to;
    public $description;
    public $location_id;
    public $account_id;
    public $amount;
    public $income;
    public $total;
    public $receipt;

    public function save(IncomeService $service){

       $validate =  $this->validate([
            "location_id"       => ['required'],
            "amount"    => ['required','regex:/^\d{1,8}(\.\d{1,2})?$/'],
            "income"        => ['required'],
            "receipt"         => ['required'],
            "description"       => ['required'],
            "date_from"          => ['required'],
            "date_to"            => ['required'],
            'account_id'      =>  ['required']
        ]);
        $validate['total'] = $this->amount;
        
        $response = $service->createAccount($validate);

        $this->reset(['location_id','account_id','amount','income','receipt','description','date_from','date_to','total']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }

    }

    public function render(BankService $account, LocationService $location)
    {
        $states = $location->listState();
        $accounts = $account->listAccounts();
        return view('livewire.entries.income', compact('states','accounts'))->layout('layouts.app');
    }
}
