<?php

namespace App\Extras\TelegramManager\Madeline\Traits;


trait AuthTrait
{
    public function login(string $phone)
    {
        try {
            $this->api->phone_login($phone);
            $this->serializeSession();
        } catch (\danog\MadelineProto\RPCErrorException $exception) {
            $this->addFails($exception, 'login');
            if ($this->failsCount('login') < $this->max_creation_try) {
                $this->login($phone);
                return;
            }
            $this->logFails('login');
        }
    }

    public function sendCode($code)
    {
        try {
            $code = $this->api->complete_phone_login($code);
            $this->serializeSession();
            return $code;
        } catch (\danog\MadelineProto\RPCErrorException $exception) {
            $this->addFails($exception, 'sendCode');
            if ($this->failsCount('sendCode') < $this->max_creation_try) {
                return $this->sendCode($code);
            }
            $this->logFails('sendCode');
        }
    }

    public function enterPassword(string $password)
    {
        try {
            $this->api->complete_2FA_login($password);
            $this->serializeSession();
        } catch (\danog\MadelineProto\RPCErrorException $exception) {
            $this->addFails($exception, 'password');
            if ($this->failsCount('password') < $this->max_creation_try) {
                $this->enterPassword($password);
                return;
            }
            $this->logFails('password');
        }
    }
}