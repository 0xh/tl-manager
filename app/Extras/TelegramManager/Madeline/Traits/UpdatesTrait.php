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
    /**
     * @param array $options
     * @return mixed
     */
    public function getUpdates($options = [])
    {
        try {
            $updates = $this->api->get_updates($options);
            return $updates;
        } catch (\Exception $exception) {
            echo "Error occurred : " . $exception->getMessage();
            if ($this->failsCount('updates') < $this->max_creation_try && str_contains($exception->getMessage(), 'socket_read():')) {
                $this->addFails($exception, 'updates');
                return $this->getUpdates($options);
            }
        }
    }

    public function testUpdates($_ = 'updateNewMessage')
    {
        $updates = $this->getUpdates();
        $d = [];
        if (is_array($updates)) {
            if (count($updates) > 0) {
                foreach ($updates as $update) {
                    if ($update['update']['_'] == $_) {
                        $d[] = $update['update'];
                    }
                }

            }
            foreach ($d as $ds) {
                print_r($this->getMessageType($ds));
            }
            return $d;
        } else {
            return $updates;
        }
    }

}