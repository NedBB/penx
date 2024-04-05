<?php

namespace App\Services;

use App\Models\Gradelevel;
use App\Models\Step;

class GradelevelService {

    public function list(){
       return Gradelevel::get();
    }

    public function listSteps(){
        return Step::get();
    }

}