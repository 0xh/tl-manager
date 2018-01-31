<?php
/**
 * Created by PhpStorm.
 * User: husseinmirzaki
 * Date: 30/01/2018
 * Time: 07:30 PM
 */

namespace App\Extras\TelegramManager\Madeline\Traits;


trait SessionTrait
{


    protected $session_prefix = 'Telegram';
    protected $session_suffix = 'session';
    protected $session_separator = '_';
    protected $session_path = __DIR__ . '/Sessions/';
    protected $session;

    protected function getSessionName(string $session = '')
    {
        if (empty($session)) {
            $session = $this->session;
        }
        return $this->session_prefix . $this->session_separator . $session . $this->session_separator . $this->session_suffix;
    }

    protected function getSessionDir($session_dir = '')
    {
        if (empty($session_dir)) {
            $session_dir = $this->root . '/Sessions/';
        }
        return $session_dir;
    }

    protected function getSessionWithDIR(string $session = '')
    {
        if (empty($session)) {
            $session = $this->getSessionName();
        }
        return $this->getSessionDir() . $session;
    }

    protected function sessionExists(string $session = '')
    {
        if (empty($session)) {
            $this->session = $session;
        }
        return !file_exists($this->getSessionWithDIR()) ?: $this->getSessionWithDIR();
    }

}