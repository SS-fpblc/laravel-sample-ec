<?php

namespace App\Exceptions;

use Exception;

class BasketException extends Exception
{
    //
    public function settleError()
    {
        return $this->message('test');
    }
}
