<?php

namespace App\Services;

use App\Models\Contributorypensionfund;
use App\Services\StaffprofileService;
use Illuminate\Support\Facades\DB;

class ContributorypensionService {


    public function getContribution($data){
        return Contributorypensionfund::with('staffprofile')
                                    ->orderBy('id')
                                    ->where([
                                        ['month', $data['month']],
                                        ['year', $data['year']]
                                    ])
                                    ->select('contributorypensionfunds.*')
                                    ->get();
    }

    public function listContributions($data){

    }

    public function getPensionSchedule($first, $end)
    {
        return Contributorypensionfund:: whereBetween('created_at', [$first, $end])
            ->get(['contribution'])
            ->sum('contribution');
    }

    public function insertPension($month, $year,array $generated){
        
        $check = Contributorypensionfund::where([
            ['month',$month],
            ['year',$year]
        ])->get();
       
        if($check->isNotEmpty()){
            return false;
        }
        else{
            return Contributorypensionfund::insert($generated);
        }
    
    }

    public function deleteSchedule($month, $year)
    {
        return Contributorypensionfund::where([['month',$month],['year',$year]])->delete();
    }




}