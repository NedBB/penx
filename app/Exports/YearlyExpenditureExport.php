<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class YearlyExpenditureExport implements FromView
{
    
    public $records;
    public $year;
    public $count = 0;

    public function __construct($records,$year )
    {
        $this->records = $records;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('livewire.exports.yearly-expenditure', [
            'records' => $this->records,
            'year' => $this->year
        ]);
    }
}
