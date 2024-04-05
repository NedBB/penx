<?php 

namespace App\Services;

use App\Models\Transportandtravel;

class TransportandtravelService{

    public function getTransportSchedule($first, $end)
    {
        return Transportandtravel::with('subhead')
            ->whereBetween('created_at', [$first, $end])
            ->oldest('pvno')
            ->get(['subhead_id','description','pvno','totalamount as amount'])
            ->groupBy('pvno');
    }


}