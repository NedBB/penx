<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class OfficerPayrollExport implements FromView
{

    public $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function view(): View
    {
        return view('livewire.exports.officer-payroll', [
            'records' => $this->records,
        ]);
    }
}
