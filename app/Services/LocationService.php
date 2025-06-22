<?php

namespace App\Services;

use App\Models\Location;

class LocationService {

    public function list($page, $search){
        return Location::search($search)->orderby('id','DESC')->paginate($page);
    }

    public function listState(){
        return Location::get();
    }

    public function create($data){
        return Location::create($data);
    }

    public function getById($id){
        return Location::find($id);
    }

    public function update($id,$data){
        $department = Location::find($id);
        $department->name = $data['name'];
        return $department->save();
    }

    public function delete($id){
        return Location::where('id',$id)->delete();
    }

}
