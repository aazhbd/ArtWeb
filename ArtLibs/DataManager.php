<?php

namespace ArtLibs;

class DataManager
{
    private $data_manager;

    function __construct($conf)
    {
        //require_once($conf->getPath() . '/vendor/lichtner/fluentpdo/' . 'FluentPDO/FluentPDO.php');
        $data = new \PDO('mysql:host='. $conf->getDbHost() .';dbname='. $conf->getDbName() .'', $conf->getDbUser(), $conf->getDbPass());
        $this->data_manager = new \FluentPDO($data);
        //$this->data_manager->debug = true;
    }

    /**
     * @return mixed
     */
    public function getDataManager()
    {
        return $this->data_manager;
    }

    /**
     * @param mixed $data_manager
     */
    public function setDataManager($data_manager)
    {
        $this->data_manager = $data_manager;
    }

}


/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
