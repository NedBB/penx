<?php

namespace App\Services;

use App\Models\Contractor;

class ContractorService {

    public function list(){
        return Contractor::with('bank')->paginate(7);
    }

    public function update(){

    }

    public function delete(){
        
    }



}
