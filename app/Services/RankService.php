<?php

namespace App\Services;

use App\Models\Dutystation;

class RankService {

    public function list(){
        return Dutystation::paginate(7);
    }

}
