<?php

namespace App\Services;

use App\Models\User;

class SystemuserService {

    public function list(){
        return User::paginate(4);
    }

}
