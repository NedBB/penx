<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService {

    public function list($page,$search){
        
        return Department::search($search)->paginate($page);
    }

    public function create($data){
        return Department::create($data);
    }

    public function getById($id){
        return Department::find($id);
    }

    public function update($id,$data){
        $department = Department::find($id);
        $department->name = $data['name'];
        $department->save();

        return $department->refresh();
    }

    public function delete($id){
        return Department::where('id',$id)->delete();
    }

}
