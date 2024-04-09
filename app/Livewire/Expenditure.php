<?php

namespace App\Livewire;

use App\Services\GroupheadService;
use Livewire\Component;

class Expenditure extends Component
{
    public $heads;
    public $start_date;
    public $end_date;
    public $head_id;
    public $records = [];
    public $columns = [];
    public $data;
    public $count = 0;
    public $show = false;
    public $federal_amount=0;
    public $state_amount=0;
    public $arrear_amount=0;
    public $contri_amount=0;
    public $advance_amount=0;
    //public $

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    public function search(GroupheadService $groupheadService){
        $this->show = true;
        $result = $groupheadService->getExpenditure($this->head_id, $this->start_date, $this->end_date);
        
        $data = $this->expenseArranged($result);
        $this->records = $data['datas'];
        $this->columns = $data['columns'];
        //dd($this->records);
    }

    private function expenseArranged($data)
    {
       // tt($data->subheads->count());
        //check single subhead
        $isSingleSubhead = ($data->subheads->count() == 1) ? true : false;
        //First extract all subheads for existing records

        $subheadarr = ['columns' => ['Y', 'M', 'PVNO','DESCRIPTION']];

        foreach($data->subheads as $subhead){
            if( $subhead->name === 'UNKNOWN'){
                if( $isSingleSubhead ) {
                    $subheadarr['columns'][] = $data->name;
                }
            }else{
                $subheadarr['columns'][] = $subhead->name;
            }
        }

        $subheadarr['columns'] = array_flip($subheadarr['columns']);

        //tt($subheadarr);
        //arranging the data
        $counter = 0;
        $subheadarr['datas'] = [];
        foreach($data->subheads as $subhead){

            if($subhead->omnibuses->isNotEmpty()){
               foreach($subhead->omnibuses as $omni) {
                   $tempArr = $subheadarr['columns'];

                   foreach($tempArr as $subarray=>$key){
                       if($subarray === 'PVNO'){
                            $pvExplode = explode('/', $omni->pvno);
                            $subheadarr['datas'][$counter]['Y'] = $pvExplode[2];
                            $subheadarr['datas'][$counter]['M'] = $pvExplode[1];
                           $subheadarr['datas'][$counter]['PVNO'] = $omni->pvno;
                           continue;
                       }

                       if($subarray === 'DESCRIPTION'){
                           $subheadarr['datas'][$counter]['DESCRIPTION'] = $omni->description;
                           continue;
                       }

                       if($subarray === $subhead->name || $isSingleSubhead){
                           $innerName = ($isSingleSubhead) ? $subarray : $subhead->name;
                           $subheadarr['datas'][$counter][$innerName] = format_money($omni->amount);
                           continue;
                       }

                       $subheadarr['datas'][$counter][$subarray] = '';
                   }
                   $counter++;
               }

            }

            if($subhead->allocations->isNotEmpty()){

                foreach($subhead->allocations as $alloc){

                    $tempArr = $subheadarr['columns'];

                        foreach($tempArr as $subarray=>$key){

                            if($subarray === 'PVNO'){
                                $pvExplode = explode('/', $alloc->pvno);
                                $subheadarr['datas'][$counter]['Y'] = $pvExplode[2];
                                $subheadarr['datas'][$counter]['M'] = $pvExplode[1];
                                $subheadarr['datas'][$counter]['PVNO'] = $alloc->pvno;
                                continue;
                            }

                            if($subarray === 'DESCRIPTION'){
                                $subheadarr['datas'][$counter]['DESCRIPTION'] = strtolower($alloc->subhead->name).' for '.
                                    $alloc->location->name;
                                continue;
                            }

                            if($subarray === $subhead->name || $isSingleSubhead){
                                $innerName = ($isSingleSubhead) ? $subarray : $subhead->name;
                                $subheadarr['datas'][$counter][$innerName] = format_money($alloc->amount);
                                continue;
                            }

                            $subheadarr['datas'][$counter][$subarray] = '';

                    }
                    $counter++;
                }

            }

            if($subhead->transportandtravels->isNotEmpty()){

                foreach ($subhead->transportandtravels as $trans){

                    $tempArr = $subheadarr['columns'];

                    foreach($tempArr as $subarray=>$key){

                        if($subarray === 'PVNO'){
                            $pvExplode = explode('/', $trans->pvno);
                            $subheadarr['datas'][$counter]['Y'] = $pvExplode[2];
                            $subheadarr['datas'][$counter]['M'] = $pvExplode[1];
                            $subheadarr['datas'][$counter]['PVNO'] = $trans->pvno;
                            continue;
                        }

                        if($subarray === 'DESCRIPTION'){
                            $subheadarr['datas'][$counter]['DESCRIPTION'] = $trans->description;
                            continue;
                        }

                        if($subarray === $subhead->name || $isSingleSubhead){
                            $innerName = ($isSingleSubhead) ? $subarray : $subhead->name;
                            $subheadarr['datas'][$counter][$innerName] = format_money($trans->amount);

                            continue;
                        }

                        $subheadarr['datas'][$counter][$subarray] = '';
                    }

                    $counter++;
                }
            }


            /*if($subhead->payrolls->isNotEmpty()){
                foreach ($subhead->payrolls as $payroll) {
                    $tempArr = $subheadarr['columns'];

                    foreach($tempArr as $subarray=>$key){
                        if($subarray === 'PVNO'){
                            $pvExplode = explode('/', $payroll->pvno);
                            $subheadarr['datas'][$counter]['Y'] = $pvExplode[2];
                            $subheadarr['datas'][$counter]['M'] = $pvExplode[1];
                            $subheadarr['datas'][$counter]['PVNO'] = $alloc->pvno;
                            continue;
                        }

                        if($subarray === 'DESCRIPTION'){
                            $subheadarr['datas'][$counter]['DESCRIPTION'] = strtolower($alloc->subhead->name).' for '.
                                $alloc->location->name;
                            continue;
                        }   
                    }
                }
            }*/

        }

       return $subheadarr;


    }

    

    public function boot(GroupheadService $groupheadService){
        $this->heads = $groupheadService->headList();
    }

    public function render()
    {
        return view('livewire.ledgers.expenditure')->layout('layouts.app');
    }
}
