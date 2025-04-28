<?php

namespace App\Repositories\member;

interface MemberInterface {
    public function store($parameters);
    public function update($parameters);
    public function delete($parameters);
}
