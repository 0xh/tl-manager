<?php

namespace App\Extras\TelegramManager\Madeline\Traits;


trait ErrorTrait
{
    /**
     * @var array $fails
     */
    protected $fails = [
        'madeline' => [],
    ];
    protected $max_creation_try = 50;

    protected function addFails($exception, $key = 'madeline')
    {
        if (!isset($this->fails[$key])) {
            $this->fails[$key] = [];
        }

        $this->fails[$key] = array_add($this->fails[$key], rand(10000000, 99999999), $exception);
    }

    protected function failsCount($key = 'madeline')
    {
        if (empty($this->fails[$key])) {
            return 0;
        }
        /** @var string $key */
        return count($this->fails[$key]);
    }

    protected function logFails($key = 'madeline')
    {
        if (isset($this->fails[$key])) {
            foreach ($this->fails[$key] as $fail) {
                \danog\MadelineProto\Logger::log($fail->getMessage());
            }
            return;
        }
        echo "Nth to log ...";

    }
}