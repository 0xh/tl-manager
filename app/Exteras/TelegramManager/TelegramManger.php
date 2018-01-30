<?php

namespace App\Exteras\TelegramManager;


use App\Exteras\TelegramManager\Traits\Madeline\SessionTrait;
use App\Exteras\TelegramManager\Traits\Madeline\TypesTrait;
use App\Exteras\TelegramManager\Traits\Madeline\UpdatesTrait;
use danog\MadelineProto\API;
use danog\MadelineProto\MTProtoTools\UpdateHandler;

class TelegramManger
{

    use TypesTrait;
    use UpdatesTrait;
    use SessionTrait;

    protected $root = __DIR__;
    protected $api;

    public function __construct($options = [])
    {
        if (!empty($options)) {
            if (is_string($options)) {

                return;
            }
        }
        $this->api = new API($options);
    }

    public function loadSession($options)
    {
        return $this->sessionExists($options);
    }
}