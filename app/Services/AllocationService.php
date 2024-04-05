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

}