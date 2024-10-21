<?php

namespace App\Services;

use App\Models\Income;


class IncomeService{

    protected $paginationTheme = 'bootstrap';

    public function createAccount($data){
      
        return Income::create([
            'remittedamount' => $data['amount'],
            'incomeperc' => $data['income'],
            'location_id' => $data['location_id'],
            'account_id' => $data['account_id'],
            'description' => $data['description'],
            'receiptno' => $data['receipt'],
            'totalincome' => $data['total'],
            'fromdate_at' => $data['date_from'],
            'todate_at' => $data['date_to']
        ]);
    }

    public function update($id, $record){
        $income = Income::find($id);
        $income->incomeperc = $record['income'];
        $income->description = $record['description'];
        $income->location_id = $record['location_id'];
        $income->account_id = $record['account_id']; 
        $income->remittedamount = $record['amount'];
        $income->totalincome = $record['total'];
        $income->receiptno = $record['receipt'];
        return $income->save();
    }

    public function getRecords($from, $to){
      
        return Income::with('location')
                       ->whereBetween('fromdate_at',[$from, $to])
                       ->get();
       
        
    }

    public function getRecordWithLocation($from, $to, int $state){
        return Income::with('location')
                       ->whereBetween('fromdate_at',[$from, $to])
                       ->where('location_id',$state)
                       ->get();
    }

    public function getRecordsOrder($from, $to){
        
        return Income::with(['account','location' => function($qr) {
                         $qr->orderBy('name', 'ASC');
                        }])->whereBetween('fromdate_at',[$from, $to])
                       ->get();
        
    }

    public function getRecordsOrderWithLocation($from, $to, int $state){
        return Income::with(['account','location' => function($qr) {
                                $qr->orderBy('name', 'ASC');
                            }])->whereBetween('fromdate_at',[$from, $to])
                        ->where('location_id',$state)
                        ->get();
    }

    public function getById($id){
        return Income::where('id',$id)->first();
    }

    public function getPrintRecord($id){
        return Income::where('id',$id)->with('location')->first();
    }

    public function delete($id){
        return Income::where('id',$id)->delete();
    }


}