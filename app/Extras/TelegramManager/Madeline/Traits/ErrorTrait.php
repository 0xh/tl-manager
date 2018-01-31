<?php

namespace App\Extras\TelegramManager\Madeline\Traits;


trait ErrorTrait
{
    /**
     * @var \Exception[] $fails
     */
    protected $fails = [];
    protected $max_creation_try = 5;

    protected function failsCount()
    {
        if (empty($this->fails)) {
            return 0;
        }
        return count($this->fails);
    }

    protected function logFails()
    {
        foreach ($this->fails as $fail) {
            \danog\MadelineProto\Logger::log($fail->getMessage());
        }
    }

}