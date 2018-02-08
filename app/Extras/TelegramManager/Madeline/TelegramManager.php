<?php

namespace App\Extras\TelegramManager\Madeline;


use App\Extras\TelegramManager\Madeline\Traits\AuthTrait;
use App\Extras\TelegramManager\Madeline\Traits\ErrorTrait;
use App\Extras\TelegramManager\Madeline\Traits\SerializeTrait;
use App\Extras\TelegramManager\Madeline\Traits\SessionTrait;
use App\Extras\TelegramManager\Madeline\Traits\TypesTrait;
use App\Extras\TelegramManager\Madeline\Traits\UpdatesTrait;
use App\Extras\TelegramManager\Madeline\Traits\UtilityTrait;
use danog\MadelineProto\API;

class TelegramManager
{

    use SessionTrait;
    use ErrorTrait;
    use TypesTrait;
    use UpdatesTrait;
    use SerializeTrait;
    use AuthTrait;
    use UtilityTrait;
    protected $root = __DIR__;
    /**
     * @var  API $api
     *
     */
    public $api;

    /**
     * TelegramManager constructor.
     * @param $options
     * @throws \Exception
     */
    public function __construct($options)
    {
        if (is_array($options) && isset($options['session'])) {
            $this->session = $options['session'];
            unset($options['session']);
        } else if (is_string($options) && $options) {
            $this->session = $options;
        } else {
            throw new \Exception('What about your session');
        }
        if (file_exists($this->getSessionWithDIR())) {
            try {
                echo "Loading data " . PHP_EOL;
                $this->loadSession($this->getSessionWithDIR());
                return;
            } catch (\Exception $exception) {
                echo "Problem Occurred : " . $exception->getMessage() . PHP_EOL;
            }
        }
        echo 'Creating a new MadelineProto instance ...' . PHP_EOL;
        $this->createNewSession($options);
    }

    public function loadSession(string $session)
    {
        $this->api = new API($session);
    }

    public function createNewSession($options)
    {
        # my default options
        $default = [
            'app_info' => [
                'api_id' => env('TL_API_ID', 6),
                'api_hash' => env('TL_API_HASH', 'b06d4abfb49dc3eeb1aeb98ae0f581e'),
            ],
            'updates' => [
                'handle_old_updates' => false
            ],
        ];
        if (is_string($options)) {
            $options = [];
        }
        if (!isset($options['app_info'])) {
            $options = [
                'app_info' => [],
            ];
            $options['app_info'] = $default['app_info'];
        } else {
            isset($options['app_info']['api_id']) ?: $options['app_info']['api_id'] = $default['app_info']['api_id'];
            isset($options['app_info']['api_hash']) ?: $options['app_info']['api_hash'] = $default['app_info']['api_hash'];
        }
        print_r($options);
        try {
            $this->api = new API($options);
            echo 'We created a new instance of MadelineProto (lol) ' . PHP_EOL;
            echo "Call it by using this session name -> '" . $this->session . "'" . PHP_EOL;
            $this->serializeSession();
        } catch (\Exception $exception) {
            echo "Problem occurred : " . $exception->getMessage();
            $this->addFails($exception);
            if ($this->failsCount() < $this->max_creation_try) {
                $this->createNewSession($options);
            } else {
                $this->logFails();
            }
        }
    }
}










