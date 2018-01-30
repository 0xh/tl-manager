<?php

namespace App\Exteras\TelegramManager\Madeline;


use App\Exteras\TelegramManager\Madeline\Traits\SessionTrait;
use App\Exteras\TelegramManager\Madeline\Traits\TypesTrait;
use App\Exteras\TelegramManager\Madeline\Traits\UpdatesTrait;
use danog\MadelineProto\API;

class TelegramManager
{

    use TypesTrait;
    use UpdatesTrait;
    use SessionTrait;

    protected
        $root = __DIR__;
    protected
        $api;

    public
    function __construct($options = [])
    {

        echo "test test test test";
        return;
        if (!empty($options)) {
            if (is_string($options)) {

                return;
            }
        }
        $this->api = new API($options);
    }

    public
    function loadSession($options)
    {
        return $this->sessionExists($options);
    }
}