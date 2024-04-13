<?php

namespace App\Livewire;

use App\Services\IncomeService;
use App\Services\LocationService;
use Livewire\Component;
use App\Exports\IncomeExport;
use Maatwebsite\Excel\Facades\Excel;

class LedgeIncome extends Component
{
    public $states;
    public $show = false;
    public $state;
    public $event = '';
    public $start_date;
    public $view = '';
    public $report_type;
    public $end_date;
    public $component;
    public $income;
    public $records = [];
    public $incomeService;

    public function boot(LocationService $locationService,){
        $this->states = $locationService->listState();
    }


    
    public function search(IncomeService $incomeService ){

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
            $this->event = $this->report_type;
            $this->component = ($this->report_type == 'summarized' ? 'ledger-income-summarize': 'ledger-income-detailed');

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
            $this->component = "ledge-income-regular";
            $this->show = true;

            
    
        }
    }

    public function export(){
        return Excel::download(new IncomeExport($this->records, $this->view), 'income.xlsx');
    }

    public function render()
    {
        //$records = $this->records;
        return view('livewire.ledgers.ledge-income')->layout('layouts.app');
    }
}
