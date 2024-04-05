<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentSchedule extends Component
{

    public $start_date;
    public $end_date;

    public function render()
    {
        return view('livewire.queries.payment-schedule')->layout('layouts.app');
    }
}
