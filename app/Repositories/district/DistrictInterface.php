<?php

namespace App\Repositories\district;

interface DistrictInterface {
    public function get_district_belongsto_city_api($request);
    public function get_district_belongsto_city($request);
    public function find($params);
}
