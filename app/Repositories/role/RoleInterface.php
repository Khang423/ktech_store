<?php

namespace App\Repositories\role;

interface RoleInterface {
    public function store($parameters);
    public function getList();
    public function update($request,$member);
    public function delete($parameters);
}
