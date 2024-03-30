<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Bank;


class BankService{

    protected $paginationTheme = 'bootstrap';

    public function bankList(){
        return Bank::paginate(5);
    }

    public function accountList(){
        return Account::with('bank')->paginate(5);
    }


}