<?php

namespace App\Repositories\member;

interface MemberInterface {
    public function store($parameters);
    public function getList();
    public function update($parameters);
    public function delete($parameters);
}
