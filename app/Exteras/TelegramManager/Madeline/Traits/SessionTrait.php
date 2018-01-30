<?php
/**
 * Created by PhpStorm.
 * User: husseinmirzaki
 * Date: 30/01/2018
 * Time: 07:30 PM
 */

namespace App\Exteras\TelegramManager\Madeline\Traits;


trait SessionTrait
{

    protected $session_prefix = 'Telegram';
    protected $session_suffix = 'session';
    protected $session_separator = '_';
    protected $session_path = __DIR__ . '/Sessions/';

    protected function getSessionName(string $session_name)
    {
        return $this->session_prefix . $this->session_separator . $session_name . $this->session_separator . $this->session_suffix;
    }

    protected function getSessionWithDIR(string $session_name)
    {
        return $this->root . '/' . $session_name;
    }

    protected function sessionExists(string $options)
    {
        return file_exists($this->getSessionWithDIR($options));
    }

}