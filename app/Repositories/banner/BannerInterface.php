<?php

namespace App\Repositories\banner;

interface BannerInterface {
    public function store($parameters);
    public function getList();
    public function update($request,$member);
    public function delete($parameters);
}
