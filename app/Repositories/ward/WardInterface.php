<?php

namespace App\Repositories\ward;

interface WardInterface {
    public function get_ward_belongsto_district_api($request);
    public function get_ward_belongsto_district($district_id);
    public function find($params);
}
