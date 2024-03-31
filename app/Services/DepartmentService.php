<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService {

    public function list(){
        return Department::paginate(7);
    }

    public function create($data){
        return Department::create($data);
    }
}
