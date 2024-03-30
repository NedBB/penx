<?php

namespace App\Models;



class Contractpayment extends Basemodel
{
    
    protected $guarded=['id'];
    
    public function contract()
    {
    	return $this->belongsTo(Contract::class);
    }
}
