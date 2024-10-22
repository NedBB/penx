<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class YearlyIncomeExport implements FromView,ShouldAutoSize
{
    
    public $exports;

    public function __construct($records )
    {
        $this->exports = $records;      
    }

    public function view(): View
    {
        return view('livewire.exports.income-yearly', [
            'data' => $this->exports
        ]);
    }
}
