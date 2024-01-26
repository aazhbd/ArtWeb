<?php

namespace ArtLibs;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class Application
{
    protected $conf_manager;

    protected $error_manager;

    protected $route_manager;

    protected $data_manager;

    protected $template_manager;

    protected $template_data;

    protected $conf;

    protected $routes;

    protected $request;

    protected $session;

    /**
     * Application constructor.
     */
    function __construct()
    {
        $this->error_manager = $this->setErrorManager();

        try {
            /* Set all configurations */
            $this->conf = $this->setConf();
            $this->conf_manager = $this->setConfManager();

            if ($this->conf_manager->getDevelopmentMode()) {
                error_reporting(E_ALL ^ E_NOTICE);
                ini_set('display_errors', 1);
                error_reporting(~0);
            }

            /* Load all libraries */
            $this->conf_manager->loadLibrary($this->conf_manager->getPath() . '/ArtLibs');
            $this->conf_manager->loadLibrary($this->conf_manager->getPath() . '/App/controller');

            if (file_exists($this->conf_manager->getPath() . '/vendor/autoload.php')) {
                require_once($this->conf_manager->getPath() . '/vendor/autoload.php');
                $this->request = Request::createFromGlobals();
            } else {
                $this->getErrorManager()->addMessage('The vendor library is missing, use composer to install dependencies.');
                return;
            }

            /* If all libraries are loaded successfully then set object */

            $this->data_manager = $this->setDataManager();

            if ($this->data_manager->getMessage()) {
                $this->getErrorManager()->addMessage('Exception occurred : ' . $this->data_manager->getMessage());
            }

            /* start session */
            $this->session = new Session();
            $this->session->start();

            $this->routes = $this->setRoutes();
            $this->route_manager = $this->setRouteManager();
            $this->template_manager = $this->setTemplateManager();

        } catch (\Exception $ex) {
            $this->getErrorManager()->addMessage('Exception occurred : ' . $ex->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getErrorManager()
    {
        return $this->error_manager;
    }

    /**
     * @param ErrorManager|null $error_manager
     * @return ErrorManager|mixed
     */
    public function setErrorManager(ErrorManager $error_manager = null)
    {
        $this->error_manager = $error_manager;

        if ($this->error_manager == null) {
            require_once('ErrorManager.php');
            $this->error_manager = new ErrorManager();
        }

        return $this->error_manager;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return DataManager
     */
    public function getDataManager()
    {
        return $this->data_manager;
    }

    /**
     * @param DataManager|null $data_manager
     * @return DataManager
     */
    public function setDataManager(DataManager $data_manager = null)
    {
        if ($data_manager != null) {
            $this->data_manager = $data_manager;
            return $this->data_manager;
        }
        $this->data_manager = new DataManager($this->getConfManager());
        return $this->data_manager;
    }

    /**
     * @return mixed
     */
    public function getRouteManager()
    {
        if (!isset($this->route_manager)) {
            $this->getErrorManager()->addMessage('Route manager is not allocated.');
            exit;
        }
        return $this->route_manager;
    }

    /**
     * @param RouteManager|null $route_manager
     * @return RouteManager|mixed
     */
    public function setRouteManager(RouteManager $route_manager = null)
    {
        $this->route_manager = $route_manager;

        if ($this->route_manager == null) {
            $this->route_manager = new RouteManager($this);
        }

        return $this->route_manager;
    }

    /**
     * @return mixed
     */
    public function getTemplateData()
    {
        return $this->template_data;
    }

    /**
     * @param array $template_data
     * @return void
     */
    public function setTemplateData(array $template_data = array())
    {
        if (empty($this->getTemplateData())) {
            $this->template_data = array(
                'path' => $this->getConfManager()->getPath(),
                'path_static' => $this->getConfManager()->getPathStatic(),
                'path_url' => $this->getConfManager()->getPathUrl(),
                'path_url_postfix' => $this->getConfManager()->getPathUrl() . $this->getConfManager()->getPathRootPostfix(),
                'errors' => $this->getErrorManager()->getMessages(),
                'user_var' => $this->getConfManager()->getUserVar(),
                'path_sys_template' => $this->getConfManager()->getPathSysTemplate(),
                'path_user_template' => $this->getConfManager()->getPathUserTemplate(),
            );
        }

        foreach ($template_data as $key => $val) {
            $this->template_data[$key] = $val;
        }
    }

    /**
     * @return mixed
     */
    public function getConfManager()
    {
        return $this->conf_manager;
    }

    /**
     * @param Configuration|null $conf_manager
     * @return Configuration|null
     */
    public function setConfManager(Configuration $conf_manager = null)
    {
        $this->conf_manager = $conf_manager;

        if ($this->conf_manager == null) {
            require_once('Configuration.php');
            $this->conf_manager = new Configuration($this);
            $this->conf_manager = $this->conf_manager->setConfiguration($this->conf);
        }

        return $this->conf_manager;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed|null
     */
    public function getConf()
    {
        return $this->conf;
    }

    /**
     * @param array $conf
     * @return array|mixed
     * @throws \Exception
     */
    public function setConf(array $conf = array())
    {
        $this->conf = $conf;

        if (empty($this->conf)) {
            $this->conf = include_once('conf.php');
        }

        if (empty($this->conf)) {
            throw new \Exception("Unable to load configuration file.");
        }

        return $this->conf;
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     * @return array|mixed
     * @throws \Exception
     */
    public function setRoutes(array $routes = array())
    {
        $this->routes = $routes;

        if (empty($this->routes)) {
            $this->routes = include('routes.php');
        }

        if (empty($this->routes)) {
            throw new \Exception("Unable to load routes file. ");
        }

        return $this->routes;
    }

    /**
     * @return mixed
     */
    public function getTemplateManager()
    {
        return $this->template_manager;
    }

    /**
     * @param TemplateManager|null $template_manager
     * @return TemplateManager|mixed
     */
    public function setTemplateManager(TemplateManager $template_manager = null)
    {
        $this->template_manager = $template_manager;

        if ($this->template_manager == null) {
            $this->template_manager = new TemplateManager($this);
        }
        return $this->template_manager;
    }
}


/**
 * An open source web application development framework for PHP 5.
 * @author        articulatedlogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 articulatedlogic Labs
 * @license       MIT License
 */
