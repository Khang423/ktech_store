<?php

namespace App\Traits;

trait Toast
{
    public function errorToast($messages = null): void
    {
        toast(__($messages),'error');
    }
}
