<?php

namespace Elchroy\UrbanDictionary;

class WordException extends \Exception
{
    public $message;

    public function __construct($msg)
    {
        $this->message = $msg;
    }
}