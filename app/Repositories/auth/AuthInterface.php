<?php

namespace App\Repositories\auth;

interface AuthInterface {
    public function login($parameters);
    public function logout();
    public function customerLogin($request);
}
