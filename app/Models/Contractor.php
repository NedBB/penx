<?php

namespace App\Models;

class Contractor extends Basemodel
{

	public $timestamps = false;

	protected $guarded=['id'];

	public function contracts()
	{
		return $this->hasMany(Contract::class);
	}

    public function bank()
    {
    	return $this->belongsTo(Bank::class);
    }

    public function title()
    {
    	return $this->belongsTo(Title::class);
    }

    public function fullname()
    {
        return $this->title->name.' '.$this->firstname.' '.$this->surname;
    }
}
