<?php

namespace App\Services;

use App\Models\Omnibus;

class OmnibusService {

    public function list(){
        return Omnibus::with('subhead.head')->orderby('updated_at','ASC')->paginate(7);
    }

    public function update(){

    }

    public function delete(){
        
    }



}
