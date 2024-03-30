<?php

namespace App\Services;

use App\Models\Conposs;


class ConpossService{

    protected $paginationTheme = 'bootstrap';

    public function list(){
        return Conposs::with('gradelevel.gradelevelname')->paginate(5);
    }


}