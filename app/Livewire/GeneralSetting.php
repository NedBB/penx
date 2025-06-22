<?php

namespace App\Livewire;

use App\Services\GeneralsettingService;
use Livewire\Component;
use Livewire\WithPagination;

class GeneralSetting extends Component
{
    use WithPagination;

    public $meal;
    public $rent;
    public $transport;
    public $employer;
    public $employee;
    public $nhf;
    public $id;

    public function boot(GeneralsettingService $service){
        $setting = $service->details();
        $this->meal = $setting->meal;
        $this->rent = $setting->rent;
        $this->transport = $setting->transport;
        $this->employer = $setting->employer_contrib;
        $this->employee = $setting->employee_contrib;
        $this->nhf = $setting->nhf;
        $this->id = $setting->id;
    }

    public function save(GeneralsettingService $service){

        $validated = $this->validate([ 
            'rent' => 'required|numeric',
            'meal' => 'required|numeric',
            'transport' => 'required|numeric',
            'employee' => 'required|numeric',
            'employer' => 'required|numeric',
            'nhf' => 'required|numeric'
        ]);

        $response = $service->update($this->id,$validated);

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }
    
    public function render()
    {
        return view('livewire.settings.general-setting')->layout('layouts.app');
    }
}
