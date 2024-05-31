<?php

namespace App\Services;

use App\Models\Head;
use App\Models\Subhead;

class GroupheadService {

    public function list($page, $search){
        return Head::search($search)->orderby('id','DESC')->with('subheads')->paginate($page);
    }

    public function subHeadList($page, $search){
        return Subhead::search($search)->orderby('id','DESC')->with('head')->paginate($page);
    }

    public function headList(){
        return Head::get();
    }

    public function getExpenditureByYear($year){
        $heads = Head::with([
            'subheads' => function($h) use ($year){
                $h->with([
                    'omnibuses'=>function($m) use($year){
                        $m->whereYear('created_at',$year)
                            ->select('id','pvno','subhead_id','description','amount');
                    },
                    'allocations'=>function($a) use($year){
                        $a->with([
                            'location'=>function($l){
                                $l->select('id','name');
                            }
                        ])->whereYear('created_at',$year)
                            ->select('id','pvno','subhead_id','netpay as amount','location_id');
                    },
                    'transportandtravels'=>function($a) use($year){
                        $a->whereYear('created_at',$year)
                            ->select('id','pvno','subhead_id','description','totalamount as amount');
                    }
                ])->select('id','head_id','name');
            }
        ])->get();

        $totalAmounts = [
            'allocations' => 0,
            'transportandtravels' => 0,
            'omnibuses' => 0
        ];
        
        foreach ($heads as $head) {
            foreach ($head->subheads as $subhead) {
                $totalAmounts['allocations'] += $subhead->allocations->sum('amount');
                $totalAmounts['transportandtravels'] += $subhead->transportandtravels->sum('amount');
                $totalAmounts['omnibuses'] += $subhead->omnibuses->sum('amount');
            }
        }

        return $heads;
    }

    public function getExpenditure($id,$from, $to){
        return  Head::where('id',$id)
        ->with([
        'subheads'=>function($h) use($from, $to){
            $h->with([
                'omnibuses'=>function($m) use($from, $to){
                    $m->whereBetween('created_at', [$from, $to])
                        ->select('id','pvno','subhead_id','description','amount');
                },
                'allocations'=>function($a) use($from, $to){
                    $a->with([
                        'location'=>function($l){
                            $l->select('id','name');
                        }
                    ])->whereBetween('created_at', [$from, $to])
                        ->select('id','pvno','subhead_id','netpay as amount','location_id');
                },
                'transportandtravels'=>function($a) use($from, $to){
                    $a->whereBetween('created_at', [$from, $to])
                        ->select('id','pvno','subhead_id','description','totalamount as amount');
                }/*,
                'payrolls'  =>  function($pr) use ($from, $to) {
                    $p->whereBetween('created_at', [$from, $to])
                    ->select('id', 'subhead_id', 'utility');
                }*/
            ])->select('id','head_id','name');
       }
    ])

    ->first();

    }

    public function create($data, $value){
        if($value == 'head'){
            return Head::create($data);
        }
        else{
            return Subhead::create($data);
        }
    }

    public function getById($id,$value){
        if($value == 'head'){
            return Head::find($id);
        }
        else{
            return Subhead::find($id);
        }
    }

    public function getSubHeadByHeadid($id){
        return Subhead::where('head_id',$id)->get();
    }

    public function updateHead($id,$data){
        $head = Head::find($id);

        $head->name = $data['name'];
        $head->slug = $data['slug'];

        return $head->save();
    }

    public function updateSubHead($id,$data){
        $sub = Subhead::find($id);

        $sub->name = $data['name'];
        $sub->head_id = $data['head_id'];

        return $sub->save();
    }

    public function delete($id, $value){
        if($value == 'head'){
            return Head::where('id',$id)->delete();
        }
        else{
            return Subhead::where('id',$id)->delete();
        }

    }

}
