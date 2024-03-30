<?php

namespace App\Services;

use App\Models\General;

class GeneralsettingService {

    public function list(){
       return General::first();
    }

}
