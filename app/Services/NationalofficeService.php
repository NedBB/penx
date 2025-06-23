<?php

namespace App\Services;

use App\Models\Nationalofficer;
use App\Models\Payroll;
use Carbon\Carbon as carbon;

class NationalofficeService {

    public function list($search){
        return Nationalofficer::search($search)
                ->select('id','uniqueid','dutystation_id','accountno','surname','firstname','middlename','basicsalary','active')
                ->with(['dutystation'])
                ->orderby('created_at','DESC')
                ->get();
    }

    public function nationalCount(){
        return Nationalofficer::get()->count();
    }

    public function getFulllist(){
        return Nationalofficer::get();
    }

    public function create($data){
        $data['active'] = true;
        return Nationalofficer::create($data);
    }

    public function getById($id){
        return Nationalofficer::find($id);
    }

    public function update($id,$data){

        $officer = Nationalofficer::find($id);

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
        $officer->active = ($data['status'] == "true")? true: false;

        return $officer->save();
    }

    public function payrollProfile($month,$year)
    {

        $data = [];
        $start_dt = icarbon($year.'-'.$month.'-01');
        $nationModel = Nationalofficer::with([
                    'fixeddeductions'=>function($d) use ($year, $month, $start_dt){
                        $d->whereRaw('"'.$start_dt.'" between `effectivedate` and `expirydate`')
                            ->select('*');
                    }
                ])
                ->where('active',1)
                ->get();


        foreach ($nationModel as $national){
            $rent = 0;
            $transport = 0;
            $meal = 0;
            $loan = ($national->fixeddeductions != null)?$national->fixeddeductions->first():0;
            
            $loan= ($loan == null)? 0:$loan['monthlydue'];
            $tax = 0;
            $pension = 0;

            $utility = $national->utility;
            $entertain = $national->entertainment;

            $gross = $national->basicsalary + $utility + $entertain;
            $deduct = 0+$tax+$pension+$loan; //Made correction on 30th Aug. 2018
            $data[] = [
                'profile_id'=>$national->id,
                'profile_type'=>'nationaloffice',
                'basicsalary'=>$national->basicsalary,
                'utility'   => $utility,
                'entertainment' => $entertain,
                'grosspay'=>$gross,
                'rent'=>$rent,
                'transport'=>$transport,
                'meal'=>$meal,
                'salaryadvance'=>0,
                'loan'=>$loan,
                'tax'=>$tax,
                'pension'=>$pension,
                'nhf'=>0,
                'totaldeduction'=>$deduct,
                'netpay'=>$gross - $deduct,
                'month'=>(int)$month,
                'year'=>(int)$year,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
        }

        return $data;

    }



}
