<?php

namespace App\Services;

use App\Models\Dutystation;

class RankService {

    public function list($page, $search){
        return Dutystation::search($search)->paginate($page);
    }

    public function create($data){
        return Dutystation::create($data);
    }

    public function getById($id){
        return Dutystation::find($id);
    }

    public function update($id,$data){
        $duty = Dutystation::find($id);
        $duty->name = $data['name'];
        return $duty->save();
    }

    public function delete($id){
        return Dutystation::where('id',$id)->delete();
    }

}
