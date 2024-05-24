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
                ->with([
                        'profile'=>function($p){
                            $p->select('id','uniqueid','firstname','surname','taxpin','pensionpin');
                        }
                    ])
                ->select('profile_id','profile_type','basicsalary',$data['option'].' as amount')
                ->get();

        if($data['option'] != 'tax' && $data['option']!= 'pension'){
            return $collect->sortBy('profile.uniqueid');
        }else{
            return $collect;
        }
    }

    public function insertPayroll($month, $year, $profile,$data)
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

    public function getPayrollSchedule($profiletype,$first, $end)
    {
        return Payroll::
             where('profile_type',$profiletype)
            ->whereBetween('created_at', [$first, $end])
            ->get(['netpay'])
            ->sum('netpay');
    }

    public function getProfilePayroll($month, $year,$profiletype){

        if($profiletype == 'staffprofile'){
            return Payroll::with(['profile' => function($query){
                            $query->with('bank');
                        }])
                        ->where('profile_type',$profiletype)
                        ->where([
                            ['month', (int)$month],
                            ['year', $year]
                        ])
                        ->get()->sortByDesc('profile.gradelevel_id');
        }else{
            return Payroll::orderby('id','asc')
                            ->where('profile_type',$profiletype)
                            ->where([
                                ['month', (int)$month],
                                ['year',$year]
                            ])
                            ->select('payrolls.*')
                            ->get()->sortByDesc('profile.dutystation_id');
        }

    }

    public function getPersonPayroll($id,$profiletype, $month, $year){
        return Payroll::with('profile')
                        ->where([
                            ['id',$id],
                            ['profile_type',$profiletype],
                            ['month',$month],
                            ['year',$year]
                        ])
                        ->first();
    }

}