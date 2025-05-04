<?php

namespace App\Repositories\brand;

interface BrandInterface {
    public function store($parameters);
    public function getList();
    public function update($request,$member);
    public function delete($parameters);
}
