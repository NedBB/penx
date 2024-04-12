<?php

namespace App\Livewire;

use App\Services\IncomeService;
use App\Services\LocationService;
use Livewire\Component;
use Livewire\Attributes\Computed;

class LedgeIncome extends Component
{
    public $states;
    public $show = false;
    public $state;
    public $start_date;
    public $view = '';
    public $report_type;
    public $end_date;
    public $income;
    public $records = [];
    public $incomeService;

    public function boot(LocationService $locationService,){
        $this->states = $locationService->listState();
    }


    
    public function search(IncomeService $incomeService ){

        //$this->incomeService = $incomeService;

        $validated = $this->validate([ 
            'state' => 'nullable',
            'start_date'=>'required',
            'end_date' => 'required',
            'report_type' => 'required'

        ]);
    

        if($this->report_type === 'summarized' || $this->report_type === 'detailed') {

       
            $income = $incomeService->getRecords($this->start_date, $this->end_date);


            if($this->state && $this->state !== 'all') {
              
                $income = $incomeService->getRecordWithLocation($this->start_date, $this->end_date, $this->state);
            }

            $income = $income->sortBy('location.name', SORT_NATURAL | SORT_FLAG_CASE)
                                ->groupBy('location.name');
            $this->records = $income->toArray();
        
            $this->view = $this->report_type;
            $this->show = true;
            
        }
     
        elseif($this->report_type == "all") {
           
            $income = $incomeService->getRecordsOrder($this->start_date, $this->end_date);
            

            if($this->state && $this->state !== 'all') {
                $income = $incomeService->getRecordsOrderWithLocation($this->start_date, $this->end_date, $this->state);
            }

            $income = $income->sortBy('location.name', SORT_NATURAL | SORT_FLAG_CASE)
                        ->groupBy('location.name');

            $this->view = $this->report_type;
            $this->records = $income->toArray();
           
            $this->show = true;

            
    
        }
    }

    public function render()
    {
        //$records = $this->records;
        return view('livewire.ledgers.ledge-income')->layout('layouts.app');
    }
}
