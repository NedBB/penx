<?php

namespace App\Services;

use App\Models\General;

class GeneralsettingService {

    public function details(){
       return General::first();
    }

    public function update($id,$data){

        $setting = General::find($id);

        $setting->rent = $data['rent'];
        $setting->meal = $data['meal'];
        $setting->transport = $data['transport'];
        $setting->employee_contrib = $data['employee'];
        $setting->employer_contrib = $data['employer'];
        $setting->nhf = $data['nhf'];
        return $setting->save();

    }

}
