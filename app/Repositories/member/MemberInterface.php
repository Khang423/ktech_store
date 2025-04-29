<?php

namespace App\Repositories\member;

interface MemberInterface {
    public function store($parameters);
    public function getList();
    public function update($request,$member);
    public function delete($parameters);
}
