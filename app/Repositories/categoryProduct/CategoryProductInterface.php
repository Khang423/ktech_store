<?php

namespace App\Repositories\categoryProduct;

interface CategoryProductInterface {
    public function store($parameters);
    public function getList();
    public function update($request,$member);
    public function delete($parameters);
}
