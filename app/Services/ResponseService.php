<?php

namespace App\Services;

class ResponseService
{
    public function __construct(public bool $success,public mixed $data)
    {
    }
}
