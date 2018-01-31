<?php

namespace App\Exteras\TelegramManager\Madeline\Traits;


trait ErrorTrait
{
    /**
     * @var \Exception[] $fails
     */
    protected $fails = [];

    protected function failsCount()
    {
        if (empty($this->fails)) {
            return 0;
        }
        return count(++$this->fails);
    }

    protected function logFails()
    {
        foreach ($this->fails as $fail) {
            \danog\MadelineProto\Logger::log($fail->getMessage());
        }
    }

}