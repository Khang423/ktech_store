<?php

namespace App\Repositories\cart;

interface CartInterface {
    public function store($parameters);
    public function getList();
    public function createCart();
    public function update($request,$member);
    public function delete($parameters);
}
