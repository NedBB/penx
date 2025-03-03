<?php

namespace App\Services;

//use App\Livewire\Ominbus;
use App\Models\Omnibus;
use Carbon\Carbon as carbon;

class OmnibusService {

    public function list($search){
        $start = date('Y').'-'.date('m').'-'.'01';
        $end = carbon::parse($start)->endOfMonth();
        return Omnibus::search($search)
                ->with('subhead.head')
                ->orderby('created_at','ASC')
                ->get();
    }

    public function updateSubhead($id,$subhead_id){
       
        $ominbus = Omnibus::find($id);
        $ominbus->subhead_id = $subhead_id;
        return $ominbus->save();
    }

    public function getRecordWithUnknownSubhead($startOfYear,$endOfYear,$subhead_id){

        return Omnibus::with('subhead')
                            ->where('subhead_id', $subhead_id)
                            ->whereBetween('created_at', [$startOfYear, $endOfYear])
                            ->get(['id','subhead_id','pvno','description','amount','created_at']);
    }

    public function getOmnibusByDateRange($date_1,$date_2){
        return Omnibus::with('subhead')
                            ->whereBetween('created_at', [$date_1, $date_2])
                            ->get(['id','subhead_id','pvno','amount']);
    }

    public function create($data){
        return Omnibus::create($data);
    }

    public function getById($id){
        return Omnibus::find($id);
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

        $ominbus = Omnibus::find($id);
        $ominbus->subhead_id = $data['subhead_id'];
        $ominbus->pvno = $data['pvno'];
        $ominbus->amount = $data['amount'];
        $ominbus->description = $data['description'];
        $ominbus->profile = $data['name'];
        $ominbus->created_at = $data['date'];

        return $ominbus->save();
    }

    public function delete($id){
        return Omnibus::where('id',$id)->delete();
    }



}
