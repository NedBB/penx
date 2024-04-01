<?php

namespace App\Services;

use App\Models\Head;
use App\Models\Subhead;

class GroupheadService {

    public function list($page, $search){
        return Head::search($search)->orderby('id','DESC')->with('subheads')->paginate($page);
    }

    public function subHeadList($page, $search){
        return Subhead::search($search)->orderby('id','DESC')->with('head')->paginate($page);
    }

    public function headList(){
        return Head::get();
    }

    public function create($data, $value){
        if($value == 'head'){
            return Head::create($data);
        }
        else{
            return Subhead::create($data);
        }
    }

    public function getById($id,$value){
        if($value == 'head'){
            return Head::find($id);
        }
        else{
            return Subhead::find($id);
        }
    }

    public function updateHead($id,$data){
        $head = Head::find($id);

        $head->name = $data['name'];
        $head->slug = $data['slug'];

        return $head->save();
    }

    public function updateSubHead($id,$data){
        $sub = Subhead::find($id);

        $sub->name = $data['name'];
        $sub->head_id = $data['head_id'];

        return $sub->save();
    }

    public function delete($id, $value){
        if($value == 'head'){
            return Head::where('id',$id)->delete();
        }
        else{
            return Subhead::where('id',$id)->delete();
        }

    }

}
