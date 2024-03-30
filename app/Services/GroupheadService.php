<?php

namespace App\Services;

use App\Models\Head;
use App\Models\Subhead;

class GroupheadService {

    public function list(){
        return Head::paginate(7);
    }

    public function subHeadList(){
        return Subhead::with('head')->paginate(7);
    }

}
