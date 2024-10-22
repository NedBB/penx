<?php

namespace App\Livewire;

use Livewire\Component;
use App\Exports\YearlyIncomeExport;
use App\Services\GroupheadService;
use App\Services\IncomeService;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class YearlyIncome extends Component
{
    public $heads;
    public $year;
    public $records;
    public $page_title = "Income";
    public $count = 0;
    public $show = false;

    public function mount()
    {
        // Load records from session if available
        if (session()->has('export_records')) {
            $this->records = session('export_records');
        }
    }

    public function search(IncomeService $incomeService){
        $this->show = true;
        $startYear = Carbon::createFromDate($this->year, 1, 1);
        $endYear = Carbon::createFromDate($this->year, 12, 31); 
        $this->records = $incomeService->getYearlyIncome($startYear, $endYear);
        session(['export_records' => $this->records]);
    }

    public function export(){
        $this->dispatch('download-excel');
        //$data = session('export_records', []);
        //return Excel::download(new YearlyIncomeExport($data), 'income-annual.xlsx');
    }

    public function hydrate()
    {
        //Cache::put('export_records', $this->records, now()->addMinutes(10));
        if (session()->has('export_records')) {
            $this->records = session('export_records');
        }

    }

    public function render()
    {
        return view('livewire.ledgers.yearly-income')->layout('layouts.app');;
    }
}
