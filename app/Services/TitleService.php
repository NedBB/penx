<?php

namespace App\Services;

use App\Models\Title;

class TitleService {

    public function list(){
       return Title::get();
    }

}