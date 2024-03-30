<?php

namespace App\Models;


class Staffprofile extends Basemodel
{
    protected $guarded = ['id'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function gradelevel()
    {
        return $this->belongsTo(Gradelevel::class);
    }

    public function pettycashrecords()
    {
        return $this->hasMany(Pettycashrecord::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function dutystation()
    {
        return $this->belongsTo(Dutystation::class);
    }

    public function paymentmethod()
    {
        return $this->belongsTo(Paymentmethod::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function payrolls()
    {
        return $this->morphMany(Payroll::class,'profile');
    }

    public function transportandtravels()
    {
        return $this->hasMany(Transportandtravel::class);
    }

   /* public function omnibuses()
    {
        return $this->hasMany(Omnibus::class);
    }*/

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function fixeddeductions()
    {
        return $this->morphMany(Fixeddeduction::class, 'profile');
    }

    public function imprests()
    {
        return $this->belongsTo(Imprest::class);
    }

    public function fullname()
    {
        return $this->surname.' '.$this->firstname.' '.$this->middlename;
    }

    public function general()
    {
        return $this->belongsTo(General::class);
    }

    public function conposs()
    {
        return $this->belongsTo(Conposs::class);
    }

    public function contributorypension()
    {
        return $this->hasMany(Contributorypensionfund::class);
    }

    public function setUtilityAttribute($value)
    {
        $this->attributes['utility'] = ($value) ?: 0.00;
    }

    public function setEntertainmentAttribute($value)
    {
        $this->attributes['entertainment'] = ($value) ?: 0.00;
    }

    public function setContributionAttribute($value)
    {
        $this->attributes['contribution'] = ($value) ?: 0.00;
    }

}
