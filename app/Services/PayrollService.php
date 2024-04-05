<?php

namespace App\Services;

use App\Models\Loantype;
use App\Models\Account;
use App\Models\Payroll;
use Illuminate\Support\Facades\DB;

class PayrollService {

    public function searchRecords($data){

        

        $collect = Payroll::whereBetween('month', [$data['month_1'], $data['month_2']])
                ->whereBetween('year', [$data['year_1'], $data['year_2']])
                ->where($data['option'], '>', 0)
                ->with(['profile' => function ($query) {
                    $query->select('id', 'surname', 'firstname', 'middlename'); // Add other common columns you need
                }])
                ->get();

                return $collect;

        
    }

    public function insertPayroll($month, $year, $profile, array $data)
    {
        $checkpayroll = Payroll::where([
                ['month',$month],
                ['year',$year],
                ['profile_type', $profile]
            ])->first();

        if($checkpayroll){
            return false;
        } else{
            return Payroll::insert($data);
        }
    }

    public function regeneratePayroll($month, $year,$profile)
    {
        return Payroll::where([
            ['month',$month],
            ['year',$year],
            ['profile_type',$profile]
        ])->delete();
    }

}