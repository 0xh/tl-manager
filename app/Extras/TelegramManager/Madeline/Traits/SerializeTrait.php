<?php

namespace App\Extras\TelegramManager\Madeline\Traits;


trait SerializeTrait
{
    protected function serializeSession()
    {
        if (!file_exists($this->getSessionDir())) {
            mkdir($this->getSessionDir());
        }
        $this->api->session = $this->getSessionWithDIR();
        $this->api->serialize();
    }

    public function serialize()
    {
        $this->serializeSession();
    }
}