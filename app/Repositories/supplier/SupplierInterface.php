<?php

namespace App\Repositories\supplier;

interface SupplierInterface {
    public function store($parameters);
    public function getList();
    public function update($request,$member);
    public function delete($parameters);
}
