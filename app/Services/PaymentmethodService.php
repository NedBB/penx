<?php 

namespace App\Services;

use App\Models\Paymentmethod;

class PaymentmethodService {

    public function list(){
        
        return Paymentmethod::get();
    }
}
