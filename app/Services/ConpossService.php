<?php

namespace App\Services;

use App\Models\Conposs;


class ConpossService{

    protected $paginationTheme = 'bootstrap';

    public function create($data){
        return Conposs::create($data);
    }

    public function getById($id){
        return Conposs::find($id);
    }

    public function update($id,$data){
        $conposs = Conposs::find($id);

        $conposs->gradelevel_id = $data['gradelevel_id'];
        $conposs->baseamount = $data['baseamount'];
        $conposs->step = $data['step'];
        $conposs->incrementrate = $data['incrementrate'];

        return $conposs->save();
    }

    public function delete($id){
        return Conposs::where('id',$id)->delete();
    }

    public function list($page,$search){
        return Conposs::search($search)->orderby('id','DESC')->with('gradelevel.gradelevelname')->paginate($page);
    }


}