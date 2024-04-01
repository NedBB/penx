<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Bank;


class BankService{

    protected $paginationTheme = 'bootstrap';

    public function bankList(){
        return Bank::get();
    }

    public function accountList($page, $search){
        return Account::search($search)->with('bank')->orderby('id','DESC')->paginate($page);
    }

    public function list($page,$search){
        return Bank::search($search)->paginate($page);
    }

    public function create($data){
        return Bank::create($data);
    }

    public function getById($id){
        return Bank::find($id);
    }

    public function update($id,$data){
        $department = Bank::find($id);
        $department->name = $data['name'];
        return $department->save();
    }

    public function delete($id){
        return Bank::where('id',$id)->delete();
    }

    public function createAccount($data){
      
        return Account::create($data);
    }

    public function getAccountById($id){
        return Account::find($id);
    }

    public function updateAccount($id,$data){
        $account = Account::find($id);
        $account->name = $data['name'];
        $account->account_number = $data['account_number'];
        $account->bank_id = $data['bank_id'];
        return $account->save();
    }

    public function deleteAccount($id){
        return Account::where('id',$id)->delete();
    }


}