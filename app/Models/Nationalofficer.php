<?php

namespace App\Models;

class Nationalofficer extends Basemodel
{
    protected $guarded = ['id'];
    
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function dutystation()
    {
        return $this->belongsTo(Dutystation::class);
    }

    public function payrolls()
    {
        return $this->morphMany(Payroll::class, 'profile');
    }

    public function fixeddeductions()
    {
        return $this->morphMany(Fixeddeduction::class, 'profile');
    }

    public function fullname()
    {
        return $this->surname.' '.$this->firstname.' '.$this->middlename;
    }

    public function scopeSearch($query,$value){
        $query->where('surname','like',"%{$value}%")->orwhere('firstname','like',"%{$value}%");
    }
}