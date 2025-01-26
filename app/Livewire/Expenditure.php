<?php

namespace App\Livewire;

use App\Exports\ExpenditureExport;
use App\Services\GroupheadService;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class Expenditure extends Component
{
    public $heads;
    public $start_date;
    public $page_title = "Expenditure";
    public $end_date;
    public $head_id;
    public $records = [];
    public $columns = [];
    public $event = '';
    public $data;
    public $count = 0;
    public $show = false;
    public $federal_amount=0;
    public $state_amount=0;
    public $arrear_amount=0;
    public $contri_amount=0;
    public $advance_amount=0;
   

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    public function search(GroupheadService $groupheadService){
        $this->show = true;
        $this->end_date = Carbon::parse($this->end_date)->endOfDay(); 
        $this->start_date = Carbon::parse($this->start_date)->startOfDay(); 
        $result = $groupheadService->getExpenditure($this->head_id, $this->start_date, $this->end_date);
       
        $data = $this->expenseArranged($result);
        //dd($data);
        $this->records = $data['datas'];
        $this->columns = $data['columns'];
        
    }

    public function exportPdf(){
        $pdf = Pdf::loadView('livewire.pdfs.expenditure-pdf',["records" => $this->records,'columns' => $this->columns,'page_title' => $this->page_title]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
            }, 'expenditure.pdf');
    }

    public function export(){
        return Excel::download(new ExpenditureExport($this->records, $this->columns), 'expenditure.xlsx');
    }

    private function expenseArranged($data)
    {
       
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
                            $subheadarr['datas'][$counter]['D'] = $pvExplode[0];
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
                                $subheadarr['datas'][$counter]['D'] = $pvExplode[0];
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
                            $subheadarr['datas'][$counter]['D'] = $pvExplode[0];
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

        }

        //dd($subheadarr);
        // Sort datas by Y (Year) and M (Month)
        // usort($subheadarr['datas'], function ($a, $b, $c) {
        //     // Compare Year first (Y), then Month (M)
        //     $yearComparison = $a['Y'] <=> $b['Y'];
        //     if ($yearComparison !== 0) {
        //         return $yearComparison;
        //     }
        //     return $a['M'] <=> $b['M']; 
        // });

        usort($subheadarr['datas'], function ($a, $b) {
            // Compare Year first (Y)
            $yearComparison = $a['Y'] <=> $b['Y'];
            if ($yearComparison !== 0) {
                return $yearComparison;
            }
        
            // If Year is the same, compare Month (M)
            $monthComparison = $a['M'] <=> $b['M'];
            if ($monthComparison !== 0) {
                return $monthComparison;
            }
        
            // If Year and Month are the same, compare Day (D)
            return $a['D'] <=> $b['D'];
        });

        $subheadarr['datas'] = array_map(function ($item) {
            unset($item['D']);
            return $item;
        }, $subheadarr['datas']);

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
