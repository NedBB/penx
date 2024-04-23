<?php

namespace App\Services;

use App\Livewire\Staff;
use App\Models\Staffprofile;
use Carbon\Carbon as carbon;

class StaffprofileService {

    public function list($search){
        return Staffprofile::search($search)
                // ->select('id','uniqueid','dutystation_id','gradelevel_id','step','surname','firstname','middlename','conposs_id','active')
                ->with(['dutystation','gradelevel.gradelevelname','conposs'])
                ->orderby('created_at','DESC')
                ->get();
    }

    public function staffCount(){
        return Staffprofile::get()->count();
    }

    public function getFulllist(){
        return Staffprofile::get();
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

    public function createPayroll($month, $year){
       
        $data = [];
       
        $start_dt = icarbon($year.'-'.$month.'-01');;
        $staffModel = Staffprofile::with([
                    'fixeddeductions'=>function($d) use ($year, $month, $start_dt){
                        $d->whereRaw('"'.$start_dt.'" between `effectivedate` and `expirydate`')
                            ->select('*');
                    },
                    'conposs'=>function($d){
                        $d->select('id','baseamount');
                    },
                    'general'=>function($d){
                       $d->select('*');
                   }
                ])
                ->where('active',1)
                ->get();

        foreach ($staffModel as $staff){

            $rent = ($staff->conposs->baseamount/12) * ($staff->general->rent/100);
            $transport = ($staff->conposs->baseamount/12) * ($staff->general->transport/100);
            $meal = ($staff->conposs->baseamount/12) * ($staff->general->meal/100);
            $salaryAdvance = 0;
            $loan = 0;

            if($staff->fixeddeductions->isNotEmpty()) {
                foreach($staff->fixeddeductions as $fixed) {
                    if($fixed->loantype_id == 7) {
                        $salaryAdvance += $fixed->monthlydue;
                    }else{
                        $loan += $fixed->monthlydue;
                    }
                }
            }

            $tax = $staff->tax;

            $utility = $staff->utility;
            $entertain = $staff->entertainment;
            $contrib = $staff->contribution;

            $basicsalary = $staff->conposs->baseamount/12;
            $gross = $basicsalary + $utility + $entertain + $rent + $transport + $meal;

            $pension = ($staff->partofcpension)
                        ? $basicsalary * ($staff->general->employee_contrib/100)
                        : 0.00;

            $deduct = 0+$tax+$pension+$loan+$salaryAdvance+$contrib;
            
            $data[] = [
                'profile_id'=>$staff->id,
                'profile_type'=>'staffprofile',
                'basicsalary'=>$basicsalary,
                'utility'   => $utility,
                'entertainment' => $entertain,
                'contribution' => $contrib,
                'grosspay'=>$gross,
                'rent'=>$rent,
                'transport'=>$transport,
                'meal'=>$meal,
                'salaryadvance'=>$salaryAdvance,
                'loan'=>$loan,
                'tax'=>$tax,
                'pension'=>$pension,
                'nhf'=>0,
                'totaldeduction'=>$deduct,
                'netpay'=>$gross - $deduct,
                'month'=>(int)$month,
                'year'=>(int)$year,
                'created_at'=>sqldatetime(),
                'updated_at'=>sqldatetime()
            ];
        }
        return $data;
    }

}
