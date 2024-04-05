<?php

namespace App\Livewire;

use App\Services\PayrollService;
use Livewire\Component;

class Deduction extends Component
{
    public $year_2;
    public $month_2;
    public $month_1;
    public $year_1;
    public $option;
    public $data = "";
    public $records = [];
   
    public $hide = true;

    public $options = ["tax" => "tax","pension" => "pension","salaryadvance"=>"salary advance"];
    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];
 
    public function search(PayrollService $service){

        $validated = $this->validate([ 
            'option' => 'required',
            'year_1' => 'required',
            'year_2' => 'required',
            'month_1' => 'required',
            'month_2' => 'required'
        ]);

        $this->records = $service->searchRecords($validated);
        $this->data = $validated['option'];
        $this->hide = false;
        
    }

    public function render()
    {
        return view('livewire.queries.deduction')->layout('layouts.app');
    }
}
