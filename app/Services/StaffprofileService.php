<?php

namespace App\Services;

use App\Models\Staffprofile;
use Carbon\Carbon as carbon;

class StaffprofileService {

    public function list($page,$search){
        return Staffprofile::search($search)
                // ->select('id','uniqueid','dutystation_id','gradelevel_id','step','surname','firstname','middlename','conposs_id','active')
                ->with(['dutystation','gradelevel.gradelevelname','conposs'])
                ->orderby('created_at','DESC')
                ->paginate($page);
    }

    public function create($data){
        return Staffprofile::create($data);
    }

    public function getById($id){
        return Staffprofile::find($id);
    }

    public function update($id,$data){

        $officer = Staffprofile::find($id);

        $officer->accountno = $data['accountno'];
        $officer->honours = $data['honours'];
        $officer->basicsalary = $data['basicsalary'];
        $officer->utility = $data['utility'];
        $officer->entertainment = $data['entertainment'];
        $officer->surname = $data['surname'];
        $officer->firstname = $data['firstname'];
        $officer->middlename = $data['middlename'];
        $officer->bank_id = $data['bank_id'];
        $officer->paymentmethod_id = $data['paymentmethod_id'];
        $officer->dutystation_id = $data['dutystation_id'];
        $officer->title_id = $data['title_id'];
        $officer->uniqueid = $data['uniqueid'];

        return $officer->save();
    }



}
