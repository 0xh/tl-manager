<?php

namespace App\Extras\TelegramManager\Madeline;


use App\Extras\TelegramManager\Madeline\Traits\ErrorTrait;
use App\Extras\TelegramManager\Madeline\Traits\SerializeTrait;
use App\Extras\TelegramManager\Madeline\Traits\SessionTrait;
use App\Extras\TelegramManager\Madeline\Traits\TypesTrait;
use App\Extras\TelegramManager\Madeline\Traits\UpdatesTrait;
use danog\MadelineProto\API;
use danog\MadelineProto\Exception;

class TelegramManager
{

    use SessionTrait;
    use ErrorTrait;
    use TypesTrait;
    use UpdatesTrait;
    use SerializeTrait;

    protected $max_creation_try = 5;
    protected $root = __DIR__;
    /**
     * @var API $api
     *
     */
    protected $api;

    public function __construct($options = [])
    {
        if (!empty($options)) {
            if (is_string($options) && $this->session = $this->sessionExists($options)) {
                try {
                    $this->loadSession($options);
                } catch (Exception $exception) {
                    echo "Problem Occurred : " . $exception->getMessage();
                }
            }
            if (!$this->session)
                throw new \Exception('What is your session name');
            $this->createNewSession($options);
        }
    }

    public function loadSession($options)
    {
        $this->api = new API($this->session);
    }

    public function createNewSession($options)
    {
        $default = [
            'app_info' => [
                'api_id' => env('TL_API_ID', 6),
                'api_hash' => env('TL_API_HASH', 'b06d4abfb49dc3eeb1aeb98ae0f581e'),
            ]
        ];
        if (!is_array($options)) {
            $this->session = $options;
        }
        if (!isset($options['session']) || !$options['session']) {
            throw new \Exception('What is your session name');
        }
        $this->session = $options['session'];
        unset($options['session']);
        if (!isset($options['app_info'])) {
            $options['app_info'] = $default['app_info'];
        } else {
            isset($options['app_info']['api_id']) ?: $options['app_info']['api_id'] = $default['app_info']['api_id'];
            isset($options['app_info']['api_hash']) ?: $options['app_info']['api_hash'] = $default['app_info']['api_hash'];
        }
        try {
            $this->api = new API($options);
            $this->serializeSession();
        } catch (Exception $exception) {
            echo "Problem occurred : " . $exception->getMessage();
            if ($this->failsCount() <= $this->max_creation_try) {
                $this->createNewSession($options);
            } else {
                $this->logFails();
            }
        }
    }
}









