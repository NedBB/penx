<?php

namespace App\Livewire;

use Livewire\Component;
use App\Exports\YearlyExpenditureExport;
use App\Services\GroupheadService;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class YearlyExpenditure extends Component
{
    public $heads;
    public $year;
    public $records;
    public $export_data;
    public $data_record;
    public $start_date;
    public $page_title = "Expenditure";
    public $count = 0;
    public $show = false;
    public $federal_amount=0;
    public $state_amount=0;
    public $arrear_amount=0;
    public $contri_amount=0;
    public $advance_amount=0;

    public function mount()
    {
        // Load records from session if available
        if (session()->has('export_records')) {
            $this->records = session('export_records');
            $this->year = session('export_year');
        }
    }

    public function search(GroupheadService $groupheadService){
       
        $this->show = true;
    
        $result = $groupheadService->getExpenditureByYear($this->year);

       // $result = $this->expenseArranged($result);
       //dd($result[0]);
        //session(['export_result' => $result, 'export_year' => $this->year]); 
        
        $this->records = $result;
        
        //Cache::put('export_records', $this->records, now()->addMinutes(10));
        session(['export_records' => $this->records, 'export_year'=>$this->year]);


        //session(['records' => $result]); 
        //dd($records[0]);
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
        $count = 0;
    
        foreach ($data as $head) {
            foreach ($head->subheads as $subhead) {
                if($subhead->name != "UNKNOWN"){
                    $totalAmounts['allocations'] += $subhead->allocations->sum('amount');
                    $totalAmounts['transportandtravels'] += $subhead->transportandtravels->sum('amount');
                    $totalAmounts['omnibuses'] += $subhead->omnibuses->sum('amount');
                    $total = $totalAmounts['allocations'] + $totalAmounts['transportandtravels'] + $totalAmounts['omnibuses'];
                    $subhead->amount = $total;
                    ++$count;
                }
            }
            $head->cols = $count;
        }

        return $data;

    }

    public function hydrate()
    {
        //Cache::put('export_records', $this->records, now()->addMinutes(10));
        if (session()->has('export_records')) {
            $this->records = session('export_records');
            $this->year = session('export_year');
        }

    }

    public function export(){
        //$data = session('records'); 
        $this->dispatch('download-excel');
     
        //$data = Cache::get('export_records', []);
        // Optionally clear the cache after export
        //Cache::forget('export_records');
       
        //return Excel::download(new YearlyExpenditureExport($data, $this->year), 'expenditures-annual.xlsx');
    }

    public function render()
    {
        return view('livewire.ledgers.yearly-expenditure')->layout('layouts.app');
    }
}
