<?php

namespace App\Services;

use App\Models\Allocation;

class AllocationService {


    public function getAllocationSchedule($date1, $date2)
    {
        return Allocation::with(['location','subhead'])
                            ->whereBetween('created_at', [$date1, $date2])
                            ->oldest('pvno')
                            ->get(['location_id','subhead_id','pvno','netpay as amount'])->groupBy('pvno');
    }

    public function getRecords($data){
        return Allocation::with(['location','subhead'])
                            ->where([
                                'month_1'=>$data['month_1'],
                                'month_2'=>$data['month_2'],
                                'year_1'=>$data['year_1'],
                                'year_2'=>$data['year_2'],
                                'subhead_id'=>$data['subhead']
                            ])->get();
    }

}