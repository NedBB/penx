<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class IncomeExport implements FromView
{

    public $records;
    public $view;

    public function __construct($records, $view)
    {
        $this->records = $records;
        $this->view = $view;     
    }

    public function view(): View
    {
        return view('livewire.exports.income', [
            'records' => $this->records,
            'view' => $this->view
        ]);
    }
}
