<?php
namespace ArtLibs;

class ErrorManager
{
    private $messages;

    private $is_error;

    private $path_log;

    /**
     * ErrorManager constructor.
     */
    function __construct()
    {
        $this->messages = array();
        $this->is_error = false;
        $this->path_log = 'artphp.log';

        file_put_contents($this->path_log, trim("Start of error log : " . date('m-d-Y h:i:s', time())) . PHP_EOL,
            FILE_APPEND);
    }

    /**
     * @return string
     */
    public function getPathLog()
    {
        return $this->path_log;
    }

    /**
     * @param string $path_log
     */
    public function setPathLog($path_log)
    {
        $this->path_log = $path_log;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param $messages
     * @return $this
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsError()
    {
        return $this->is_error;
    }

    /**
     * @param $is_error
     */
    public function setIsError($is_error)
    {
        $this->is_error = $is_error;
    }

    /**
     * @param $message
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
        $this->is_error = true;

        foreach ($this->messages as $m) {
            if (!empty($m)) {
                echo "Error : " . $m . "<br />";
                file_put_contents($this->path_log,
                    trim("Error occurred at : " . date('m-d-Y h:i:s', time()) . " Message: " . $m) . PHP_EOL, FILE_APPEND);
            }
        }
    }
}






/**
 * An open source web application development framework for PHP 5.
 * @author        articulatedlogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 articulatedlogic Labs
 * @license       MIT License
 */
