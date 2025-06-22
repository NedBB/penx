<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class YearlyExpenditureExport implements FromView,ShouldAutoSize
{
    
    public $exports;
    public $year;
    public $count = 0;

    public function __construct($result,$year )
    {

        $this->exports = $result;
        $this->year = $year;
       
      
    }

    public function view(): View
    {
        
        return view('livewire.exports.expenditure-yearly', [
            'data' => $this->exports,
            'year' => $this->year
        ]);
    }
}
