<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Contractpayment;

class ContractService {

    public function getRecords(){
        return Contract::with('contractor')->paginate(10);
    }

    public function getById($id){
        return Contract::find($id);
    }

    public function getFullList(){
        return Contract::get();
    }

    public function getContractPayment($id){
        return Contractpayment::where('contract_id',$id)->first();
    }

    public function create($data){
      
        $model = Contract::create([
            'contractor_id' => $data['contractor'],
            'number' => generate_numbers(8),
            'company_name' => $data['company_name'],
            'title' => $data['contract_title'],
            'description' => $data['description'],
            'cost' => $data['cost'],
            'stat_at' => $data['start_date'],
            'expected_end_at' => $data['expected_delivery_date']
        ]);

        return $model->contractpayments()->create([
            'note' => 'First Payment',
            'paid_amount' => $data['payment'],
            'paid_date' => $data['payment_date']
        ]);
    }

    public function update($id,$data){
    
        $record = Contract::find($id);
        $recordb = $record;
        $record->contractor_id = $data['contractor'];
        $record->company_name = $data['company_name'];
        $record->title = $data['contract_title'];
        $record->description = $data['description'];
        $record->cost = $data['cost'];
        $record->stat_at = $data['stat_at'];
        $record->expected_end_at = $data['expected_delivery_date'];

        //$record->save();

        $constractPayment = $recordb->contractpayments->first(); 
        dd($constractPayment);
        $constractPayment->paid_date = $data['payment_date'];
        $constractPayment->paid_amount = $data['payment'];
        return $constractPayment->save();
    }

    public function delete($id){
        return Contract::where('id',$id)->delete();
    }

}