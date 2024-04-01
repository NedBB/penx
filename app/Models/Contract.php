<?php

namespace App\Models;


class Contract extends Basemodel
{

	protected $guarded=['id'];

    public function contractor()
    {
    	return $this->belongsTo(Contractor::class);
    }

    public function contractpayments()
    {
    	return $this->hasMany(Contractpayment::class);
    }

    public function getStartAtAttribute($value)
    {
    	return sqldate($value);
    }

    public function getExpectedEndAtAttribute($value)
    {
    	return sqldate($value);
    }

    public function getCreatedAtAttribute($value)
    {
    	return sqldate($value);
    }

    public function getEndAtAttribute($value)
    {
    	return ($value) ? sqldate($value) : null;
    }

    public function getCostAttribute($value)
    {
        return format_money($value);
    }

    public function scopeSearch($query,$value){
        $query->where('name','like',"%{$value}%");
    }

}
