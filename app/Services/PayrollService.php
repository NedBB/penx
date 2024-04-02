<?php

namespace App\Services;

use App\Models\Loantype;
use App\Models\Account;
use App\Models\Payroll;

class PayrollService {

    public function searchRecords($data){

        $collect  =   Payroll::whereBetween('month', [$data['month_1'], $data['month_2']])
                ->whereBetween('year', [$data['year_1'], $data['year_2']])
                ->where($data['option'], '>', 0)
                ->with([
                        'profile'=>function($p){
                            $p->select('id','uniqueid','firstname','surname', 'taxpin','pensionpin');
                        }
                    ])
                ->select('profile_id','profile_type','basicsalary',$data['option'].' as amount')
                ->get();
                
            if($data['option'] != 'tax' && $data['option'] != 'pension'){
                return $collect->sortBy('profile.uniqueid');
            }
            else{
                return $collect;
            }
        
    }

}