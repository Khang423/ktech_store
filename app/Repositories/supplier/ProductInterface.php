<?php

namespace App\Repositories\product;

interface ProductInterface {
    public function store($parameters);
    public function getList();
    public function update($request,$member);
    public function delete($parameters);
}
