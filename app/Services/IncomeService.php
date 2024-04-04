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


}