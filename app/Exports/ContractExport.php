<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ContractExport implements FromView
{
    public $records;
    public $data;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function view(): View
    {
        return view('livewire.exports.contract', [
            'contracts' => $this->records,
        ]);
    }
}
