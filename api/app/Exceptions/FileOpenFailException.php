<?php

namespace App\Exceptions;

use App\Exceptions\LogException;

class FileOpenFailException extends LogException
{

    public function __construct(&$loggerHandler, $message = 'File open fail', $detail = array(), $code = 0, Exception $previous = null)
    {
        parent::__construct($loggerHandler, 'File open fail', $detail, $code, $previous);
    }

}
