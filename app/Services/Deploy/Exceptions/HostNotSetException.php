<?php

namespace App\Services\Deploy\Exceptions;

use Exception;

class HostNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct("Server not set for this task.");
    }
}
