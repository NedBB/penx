<?php

namespace App\Services;

use App\Models\Gradelevel;

class GradelevelService {

    public function list(){
       return Gradelevel::get();
    }

}