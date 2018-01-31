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
        return $this->api->get_update();
    }
}