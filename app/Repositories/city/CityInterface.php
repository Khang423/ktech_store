<?php

namespace App\Repositories\city;

interface CityInterface {
    public function get_all();
    public function find($params);
}
