`<?php
/**
 * Created by PhpStorm.
 * User: husseinmirzaki
 * Date: 1/31/2018
 * Time: 9:49 PM
 */

namespace App\Extras\TelegramManager\Madeline\Traits;


trait AuthTrait
{
    public function login(string $phone)
    {
        try {
            $this->api->phone_login($phone);
        } catch (\danog\MadelineProto\RPCErrorException $exception) {
            if ($this->failsCount() < $this->max_creation_try) {
                $this->login($phone);
                return;
            }
            $this->logFails();
        }
    }

    public function sendCode($code)
    {
    }

    public function enterPassword(string $password)
    {
    }
}`