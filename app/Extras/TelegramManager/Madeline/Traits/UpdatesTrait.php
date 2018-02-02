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
            return $updates;
        } catch (\Exception $exception) {
            if ($this->failsCount('updates') < $this->max_creation_try && str_contains($exception->getMessage(), 'socket_read():')) {
                $this->addFails($exception, 'updates');
                return $this->getUpdates($options);
            }
        }
    }
}