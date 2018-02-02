<?php

namespace App\Extras\Sample;

use App\Extras\TelegramManager\Madeline\TelegramManager;

class Sample
{
    public $madeline;
    public $last_updates;

    public function __construct()
    {
        $this->madeline = new TelegramManager('samples');
        try {
            $this->madeline->api->get_updates();
        } catch (\Exception $exception) {
            if (str_contains($exception->getMessage(), 'socket_read(): unable to read from socket')) {
                $this->login();
            }
        }
    }

    public function get_updates_test()
    {
        $this->madeline->getUpdates();
    }

    /**
     * @param string $phone_number
     * @param string $code
     * @param string $password
     */
    public function login($phone_number = '', $code = '', $password = '')
    {
        if (empty($phone_number)) {
            $phone_number = readline('Enter your phone number : ');
            try {
                $this->madeline->login($phone_number);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
                $this->login();
                return;
            }
        }
        if (empty($code)) {
            $code = readline('Please enter the code you received : ');
            try {
                $code = $this->madeline->sendCode($code);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
                $this->login($phone_number);
                return;
            }
        }
        if (isset($code['_'])) {
            if ($code['_'] === 'account.password') {
                if (empty($password)) {
                    $password = readline('Please enter your account password : ');
                    try {
                        $this->madeline->enterPassword($code);
                    } catch (\Exception $exception) {
                        echo $exception->getMessage();
                        $this->login($phone_number, $code);
                        return;
                    }
                }
            }
        }

    }

}