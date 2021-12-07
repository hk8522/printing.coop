<?php

namespace Flagship\Shipping\Exceptions;

use Flagship\Shipping\Exceptions\SmartshipException;

class GetDhlEcommRatesException extends SmartshipException{ 

    public function __construct(string $message, int $code=0){

       parent::__construct($message,$code);
       $this->message = implode("\n",$this->getErrors());
    }
}