<?php

namespace App\Models;



class Category extends Basemodel
{
    public function profiles()
    {
        return $this->hasMany(Staffprofile::class);
    }
}
