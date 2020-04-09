<?php

namespace App\Exceptions;

use \stdClass;
use Exception;
use App\Customize\Http\HttpResponse;

use App\Mail\System\SystemErrorMail;
use Illuminate\Support\Facades\Mail;

class LogException extends Exception
{
    protected $loggerHandler, $message, $detail, $http_res;

    /**
     * logger : Monolog - logger
     * message : title
     * detail : variable
     *
     * @param logger
     * @param message
     * @param detail
     *
     */

    public function __construct(&$loggerHandler, $message, $detail = array(), $code = 0, Exception $previous = null)
    {
        $this->http_res = new HttpResponse();
        $this->message = $message;
        $this->detail = $detail;
        $this->loggerHandler = &$loggerHandler;
        parent::__construct($message, $code, $previous);
    }

    public function report()
    {
        $this->loggerHandler->error($this->message,$this->detail);
        $this->http_res->error($this->message);
        $data = [
            'message'=>$this->message,
            'detail' => $this->detail
        ];

        /*
            Mail::to(config('mail.debug_group.address'))
                ->send(new SystemErrorMail($data));
        */
        exit();

    }
}
