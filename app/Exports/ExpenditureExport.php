<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExpenditureExport implements FromView
{
    
    public $records;
    public $columns;
    public $count = 0;

    public function __construct($records, $columns)
    {
        $this->records = $records;
        $this->columns = $columns;
    }

    public function view(): View
    {
        return view('livewire.exports.expenditure', [
            'records' => $this->records,
            'columns' => $this->columns,
            'count' => $this->count
        ]);
    }
}
