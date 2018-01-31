<?php
/**
 * Created by PhpStorm.
 * User: husseinmirzaki
 * Date: 30/01/2018
 * Time: 07:07 PM
 */

namespace App\Extras\TelegramManager\Madeline\Traits;


trait UpdatesTrait
{
    public function getUpdates($options = [])
    {
        try {
            $updates = $this->api->get_updates();
        } catch (\danog\MadelineProto\RPCErrorException $exception) {
            dd($exception);
        }
    }
}