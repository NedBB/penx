<?php

namespace App\Livewire;

use Livewire\Component;
use App\Exports\YearlyExpenditureExport;
use App\Services\GroupheadService;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class YearlyExpenditure extends Component
{
    public $heads;
    public $year;
    public $records;
    public $start_date;
    public $page_title = "Expenditure";
    public $end_date;
    public $head_id;
    public $columns = [];
    public $event = '';
    public $data;
    public $count = 0;
    public $show = false;
    public $federal_amount=0;
    public $state_amount=0;
    public $arrear_amount=0;
    public $contri_amount=0;
    public $advance_amount=0;

    public function search(GroupheadService $groupheadService){
        //dd($this->year);
        $this->show = true;
        $result = $groupheadService->getExpenditureByYear($this->year);

        $this->records = $this->expenseArranged($result);
        //dd($record[0]);
        // $data = $this->expenseArranged($result);
        // $this->records = $data['datas'];
        // $this->columns = $data['columns'];
        
    }

    private function expenseArranged($data)
    {
        $totalAmounts = [
            'allocations' => 0,
            'transportandtravels' => 0,
            'omnibuses' => 0
        ];
    
        foreach ($data as $head) {
            foreach ($head->subheads as $subhead) {
                $totalAmounts['allocations'] += $subhead->allocations->sum('amount');
                $totalAmounts['transportandtravels'] += $subhead->transportandtravels->sum('amount');
                $totalAmounts['omnibuses'] += $subhead->omnibuses->sum('amount');
                $total = $totalAmounts['allocations'] + $totalAmounts['transportandtravels'] + $totalAmounts['omnibuses'];
                $subhead->amount = $total;
            }
            $head->cols = count($head->subheads);
        }

        return $data;


    }

    public function export(){
        return Excel::download(new YearlyExpenditureExport($this->records, $this->year), 'expenditures.xlsx');
    }

    public function render()
    {
        return view('livewire.ledgers.yearly-expenditure')->layout('layouts.app');
    }
}
