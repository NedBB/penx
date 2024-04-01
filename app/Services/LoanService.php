<?php

namespace App\Services;

use App\Models\Loantype;
use App\Models\Account;

class LoanService {

    public function accountList(){
        return Account::with('bank')->paginate(5);
    }

    public function list($page,$search){
        return Loantype::search($search)->paginate($page);
    }

    public function create($data){
        return Loantype::create($data);
    }

    public function getById($id){
        return Loantype::find($id);
    }

    public function update($id,$data){
        $loantype = Loantype::find($id);
        $loantype->name = $data['name'];
        $loantype->interestrate = $data['interestrate'];
        return $loantype->save();
    }

    public function delete($id){
        return Loantype::where('id',$id)->delete();
    }

}
