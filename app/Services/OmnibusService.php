<?php

namespace App\Services;

use App\Livewire\Ominbus;
use App\Models\Omnibus;
use Carbon\Carbon as carbon;

class OmnibusService {

    public function list($page,$search){
        $start = date('Y').'-'.date('m').'-'.'01';
        $end = carbon::parse($start)->endOfMonth();
        return Omnibus::search($search)
                ->with('subhead.head')
                ->orderby('created_at','ASC')
                ->paginate($page);
    }

    public function create($data){
        return Omnibus::create($data);
    }

    public function getById($id){
        return Ominbus::find($id);
    }

    public function getOmnibusSchedule($first, $end)
    {
        return Omnibus::with('subhead')
                    ->whereBetween('created_at', [$first, $end])
                    ->oldest('pvno')
                    ->get(['subhead_id','description','pvno','amount'])
                    ->groupBy('pvno');
    }

    public function update($id,$data){

        $ominbus = Ominbus::find($id);
        $ominbus->subhead_id = $data['subhead_id'];
        $ominbus->pvno = $data['pvno'];
        $ominbus->amount = $data['amount'];
        $ominbus->description = $data['description'];
        $ominbus->profile = $data['profile'];

        return $ominbus->save();
    }

    public function delete($id){
        return Ominbus::where('id',$id)->delete();
    }



}
