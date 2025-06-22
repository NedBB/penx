<?php

namespace App\Services;

use App\Models\Dutystation;

class DutystationService {

    public function list(){
        
        return Dutystation::get();
    }
}
