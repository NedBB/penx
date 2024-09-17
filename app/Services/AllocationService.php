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

    public function getAllocationByDateRange($date_1,$date_2){
        return Allocation::with('head','subhead')
                            ->whereBetween('created_at', [$date_1, $date_2])
                            ->get(['id','head_id','pvno','netpay as amount']);
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

    public function getRecordById($id){
        return Allocation::find($id);
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

    public function updateRecord($id,$data){
         
            $record = Allocation::find($id);
        
            $record->head_id = $data['head_id'];
            $record->subhead_id = $data['subhead_id'];
            $record->location_id = $data['location_id'];
            $record->remittedamount = $data['amount'];
            $record->pvno = $data['pvno'];
            $record->allocationpercent = $data['allocation_field'];
            $record->divisionpercent = $data['divisionpercent'];
            $record->grosspay = $data['gross_pay'];
            $record->netpay = $data['net_pay'];
            $record->contributiontonlc = $data['nlc'];
            $record->legal = $data['legal'];
            $record->constitution = $data['constitution'];
            $record->almanac = $data['almanac'];
            $record->badges = $data['badges'];
            $record->advanceallocation = $data['advance_allocation'];
            $record->arrears = $data['arrears'];
            $record->magazine = $data['northern_dues'];
            $record->auditfee = $data['audit_fees'];
            $record->month_1 = $data['month_1'];
            $record->month_2 = $data['month_2'];
            $record->year_2 = $data['year_2'];
            $record->year_1 = $data['year_1'];

            return $record->save();
    }


    public function delete($id){
        return Allocation::where('id',$id)->delete();
    }
}