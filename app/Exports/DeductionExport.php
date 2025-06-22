<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class DeductionExport implements FromView
{

    public $records;
    public $data;

    public function __construct($records, $data)
    {
        $this->records = $records;
        $this->data = $data;
    }

    public function view(): View
    {
        return view('livewire.exports.deduction', [
            'records' => $this->records,
            'data' => $this->data
        ]);
    }
}
