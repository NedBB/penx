<?php

namespace App\Services;

use App\Models\Fixeddeduction;

class FixeddeductionService {

    public function getRecords($data){
        $first = $data['year_1'].'-'.$data['month_1'].'-01';
        $end = $data['year_2'].'-'.$data['month_2'].'-01';
        $endmonth = icarbon($end)->endOfMonth()->toDateString();

        return Fixeddeduction::with('loantype', 'profile')
                                ->whereBetween('effectivedate', [$first, $endmonth])
                                ->get();
    }

    public function getById($id){
        return Fixeddeduction::find($id);
    }

    public function create($data){
        return Fixeddeduction::create($data);
    }

    public function update($id,$data){
    
        $record = Fixeddeduction::find($id);

        $record->profile_type = $data['profile'];
        $record->profile_id = $data['profile_id'];
        $record->payableamount = $data['payable'];
        $record->effectivedate = $data['effect_month'];
        $record->expirydate = $data['expiry_month'];
        $record->loantype_id = $data['loantype_id'];
        $record->principalamount = $data['principal'];
        $record->period = $data['period'];
        $record->monthlydue = $data['monthly_due'];

        return $record->save();
    }

    public function delete($id){
        return Fixeddeduction::where('id',$id)->delete();
    }

}