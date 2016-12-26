<?php

namespace ArtLibs;

class DataManager
{
    private $data_manager;

    private $message;

    /**
     * DataManager constructor.
     * @param Configuration $conf
     */
    function __construct(Configuration $conf)
    {
        $this->message = "";

        try {
            $data = new \PDO('mysql:host=' . $conf->getDbHost() . ';dbname=' . $conf->getDbName() . '', $conf->getDbUser(), $conf->getDbPass());
            $this->data_manager = new \FluentPDO($data);
            $this->data_manager->debug = false;
        } catch (\Exception $ex) {
            $this->message = "Database connection failed : " . $ex->getMessage();
        }
    }

    /**
     * @return \FluentPDO
     */
    public function getDataManager()
    {
        return $this->data_manager;
    }

    /**
     * @param $data_manager
     * @return \FluentPDO
     */
    public function setDataManager($data_manager)
    {
        $this->data_manager = $data_manager;
        return $this->data_manager;
    }

    /**
     * @return bool|string
     */
    public function getMessage()
    {
        if ($this->message != "") {
            return $this->message;
        } else {
            return false;
        }
    }

    /**
     * @param $message
     * @return string
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this->message;
    }
}


/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
