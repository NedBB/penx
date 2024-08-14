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
                                'subhead_id'=>$data['subhead_search_field']
                            
                            ])->orderby('location_id')->get();
    }

    public function getRecordsByPvno($pvno){
        return Allocation::with(['location','subhead'])
                            ->where('pvno', $pvno)
                            ->orderby('location_id')
                            ->get();
    }

    public function createRecord($data){
        return Allocation::create([
            'head_id' => $data['head_id'],
            'subhead_id' => $data['subhead_id'],
            'location_id' => $data['location_id'],
            'remittedamount' => $data['amount'],
            'pvno' => $data['pvno'],
            'allocationpercent' => $data['allocation_field'],
            'divisionpercent' => $data['divisionpercent'],
            'grosspay' => $data['gross_pay'],
            'netpay' => $data['net_pay'],
            'contributiontonlc' => $data['nlc'],
            'legal' => $data['legal'],
            'constitution' => $data['constitution'],
            'almanac' => $data['almanac'],
            'badges' => $data['badges'],
            'advanceallocation' => $data['advance_allocation'],
            'arrears' => $data['arrears'],
            'magazine' => $data['northern_dues'],
            'auditfee' => $data['audit_fees'],
            'month_1' => $data['month_1'],
            'month_2' => $data['month_2'],
            'year_2' => $data['year_2'],
            'year_1' => $data['year_1'],
        ]);
    }


    public function delete($id){
        return Allocation::where('id',$id)->delete();
    }
}