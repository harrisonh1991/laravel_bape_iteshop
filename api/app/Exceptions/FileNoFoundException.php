<?php

namespace App\Exceptions;

use App\Exceptions\LogException;

class FileNoFoundException extends LogException
{

    public function __construct(&$loggerHandler, $message = 'File No Found', $detail = array(), $code = 0, Exception $previous = null)
    {
        parent::__construct($loggerHandler, 'File No Found', $detail, $code, $previous);
    }

}
