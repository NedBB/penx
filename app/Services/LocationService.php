<?php

namespace App\Services;

use App\Models\Location;

class LocationService {

    public function list(){
        return Location::paginate(4);
    }

}
