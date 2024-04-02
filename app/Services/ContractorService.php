<?php

namespace App\Services;

use App\Models\Contractor;

class ContractorService {

    public function list($page,$search){
        return Contractor::search($search)->with(['bank','title'])->paginate($page);
    }

    public function create($data){
        return Contractor::create($data);
    }

    public function getById($id){
        return Contractor::find($id);
    }

    public function update($id,$data){
        $contractor = Contractor::find($id);

        $contractor->contractor = $data['number'];
        $contractor->surname = $data['surname'];
        $contractor->firstname = $data['firstname'];
        $contractor->title_id = $data['title_id'];
        $contractor->bank_id = $data['bank_id'];
        $contractor->address = $data['address'];
        $contractor->account_name = $data['account_name'];
        $contractor->account_no = $data['account_no'];

        return $contractor->save();
    }

    public function delete($id){
        return Contractor::where('id',$id)->delete();
    }

}
