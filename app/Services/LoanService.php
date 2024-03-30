<?php

namespace App\Services;

use App\Models\Loantype;

class LoanService {

    public function list(){
        return Loantype::paginate(4);
    }

}
