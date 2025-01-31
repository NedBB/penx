<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExpenditureExport implements FromView
{
    
    public $records;
    public $columns;
    public $footer;
    public $count = 0;

    public function __construct($records, $columns, $footer)
    {
        $this->records = $records;
        $this->columns = $columns;
        $this->footer = $footer;
    }

    public function view(): View
    {
        return view('livewire.exports.expenditure', [
            'records' => $this->records,
            'columns' => $this->columns,
            'footer' => $this-> footer,
            'count' => $this->count
        ]);
    }
}
