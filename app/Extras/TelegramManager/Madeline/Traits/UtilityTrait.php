<?php
/**
 * Created by PhpStorm.
 * User: husseinmirzaki
 * Date: 2/5/2018
 * Time: 6:59 PM
 */

namespace App\Extras\TelegramManager\Madeline\Traits;


trait UtilityTrait
{
    public $last_update_types = [];

    public function getMessageType($message)
    {
        $has = [];
        if (isset($message['message'])) {
            if (!empty($message['message']['message'])) {
                $has[] = 'text';
            }
            if (isset($message['message']['media']['caption'])) {
                $has[] = 'caption';
            }
            #it is not a text message
            if (isset($message['message']['media'])) {
                # a file | sticker | video | rounded video | gif
                if (isset($message['message']['media']['document'])) {
                    $message = $message['message']['media']['document'];
                    if ($message['mime_type'] == 'image/webp') {
                        $has[] = 'sticker';
                    } else if ($message['mime_type'] == 'audio/ogg') {
                        if (isset($message['attributes'][0]['voice'])) {
                            if ($message['attributes'][0]['voice']) {
                                $has[] = 'voice';
                            }
                        }
                    } else if ($message['mime_type'] == 'video/mp4') {
                        if (isset($message['attributes'][0]['round_message'])) {
                            if ($message['attributes'][0]['round_message']) {
                                $has[] = 'round_video';
                            } else {
                                $has[] = 'video';
                            }
                        } else {
                            $has[] = 'video';
                        }
                    } else {
                        $has[] = 'file';
                    }
                } # a photo
                else if (isset($message['message']['media']['photo'])) {
                    $has[] = 'photo';
                } else if ($message['message']['media']['_'] == 'messageMediaContact') {
                    $has[] = 'contact';
                }
            }
        }
        $this->last_update_types = $has;
        return $has;
    }

    public function messageIsOf($type, &$message = [])
    {
        $types = $this->last_update_types;
        if (is_array($message) && !empty($message)) {
            $type = $this->getMessageType($message);
        }
        return $this->hasValue($type, $types);
    }

    public function hasValue($value, $array)
    {
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $key) {
                if ($value == $key)
                    return true;
            }
        }
        return false;
    }

}