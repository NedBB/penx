<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService {

    public function list(){
        return Department::paginate(7);
    }
}
