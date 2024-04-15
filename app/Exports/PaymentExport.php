<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PaymentExport implements FromView
{
    public $pension;
    public $nationpayroll;
    public $staffpayroll;
    public $sort;

    public function __construct($pension, $nationpayroll, $staffpayroll,$sort)
    {
        $this->pension = $pension;
        $this->nationpayroll = $nationpayroll;
        $this->staffpayroll = $staffpayroll;
        $this->sort = $sort;
    }

    public function view(): View
    {
        return view('livewire.exports.payment', [
            'pension' => $this->pension,
            'sort' => $this->sort,
            'staffpayroll' => $this->staffpayroll,
            'nationpayroll' => $this->nationpayroll
        ]);
    }

}