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

    public function getByPvno($pvno){
        return Transportandtravel::with('subhead')
            ->where('pvno',$pvno)
            ->get();
    }

    public function createRecord($data){
        return Transportandtravel::create([
            'profile' => isset($data['name']) ? $data['name'] : null,
            'subhead_id' => $data['subhead_id'],
            'transportallowance' => $data['transport'],
            'pvno' => $data['pvno'],
            'totalamount' => $data['grand_total'],
            'description' => $data['description'],
            'foodallowance' => $data['food'],
            'fa_multiple' => $data['food_multiple'],
            'houseallowance' => $data['house'],
            'ha_multiple' => $data['house_multiple'],
            'sittingallowance' => $data['seating'],
            'sa_multiple' => $data['seating_multiple'],
            'outstationallowance' => $data['outstation'],
            'os_multiple' => $data['outstation_multiple']
        ]);
    }

    public function getRecordById($id){
        return Transportandtravel::find($id);
    }

    public function update($id,$data){
        $record = Transportandtravel::find($id);

        $record->profile = isset($data['name']) ? $data['name'] : null;
        $record->subhead_id = $data['subhead_id'];
        $record->transportallowance = $data['transport'];
        $record->pvno = $data['pvno'];
        $record->totalamount = $data['grand_total'];
        $record->description = $data['description'];
        $record->foodallowance = $data['food'];
        $record->fa_multiple = $data['food_multiple'];
        $record->houseallowance = $data['house'];
        $record->ha_multiple = $data['house_multiple'];
        $record->sittingallowance = $data['seating'];
        $record->sa_multiple = $data['seating_multiple'];
        $record->outstationallowance = $data['outstation'];
        $record->os_multiple = $data['outstation_multiple'];

        return $record->save();
    }


}