<?php

namespace App\Extras\TelegramManager\Madeline\Traits;


trait SerializeTrait
{
    protected function serializeSession()
    {
        $this->api->session = $this->getSessionWithDIR();
        $this->api->serialize();
    }
}