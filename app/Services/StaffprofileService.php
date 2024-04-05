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

    public function generateContributoryPension($month, $year)
    {
        $staffModel = Staffprofile::with([
                'conposs'=>function($d){
                    $d->select('id','baseamount');
                },
                'general'=>function($d){
                    $d->select('*');
                }
            ])
            ->where([['active',1],['partofcpension',1]])
            ->get();

        foreach ($staffModel as $staff){
            $staffcontri = ($staff->conposs->baseamount/12) * ($staff->general->employee_contrib/100);
            $employerContri = ($staff->conposs->baseamount/12) * ($staff->general->employer_contrib/100);
            $contribution = $staffcontri + $employerContri;
            $pensionpin = $staff->pensionpin;
         
            $data[] = [
                'staffprofile_id'=>$staff->id,
                'pensionpin'=>$pensionpin,
                'employer_pension'=>number_format($employerContri, 2, '.',''),
                'employee_pension'=>number_format($staffcontri, 2, '.',''),
                'contribution'=>number_format($contribution, 2, '.',''),
                'month'=>(int)$month,
                'year'=>(int)$year
            ];
        }

        return $data;

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
