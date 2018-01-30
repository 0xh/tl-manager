<?php

namespace App\Exteras\TelegramManager\Madeline;


use App\Exteras\TelegramManager\Madeline\Traits\SessionTrait;
use App\Exteras\TelegramManager\Madeline\Traits\TypesTrait;
use App\Exteras\TelegramManager\Madeline\Traits\UpdatesTrait;
use danog\MadelineProto\API;
use danog\MadelineProto\Exception;

class TelegramManager
{

    use TypesTrait;
    use UpdatesTrait;
    use SessionTrait;

    protected $root = __DIR__;
    protected $api;

    public function __construct($options = [])
    {
        if (!empty($options)) {
            if (is_string($options) && $session = $this->sessionExists($options)) {
                try{
                    $this->api = new API($session);
                } catch (Exception $exception){
                    echo "Problem Occurred : ".$exception->getMessage();
                }
            }
        }
    }

    public function loadSession($options)
    {
        return $this->sessionExists($options);
    }
}