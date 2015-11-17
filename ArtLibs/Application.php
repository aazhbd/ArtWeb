<?php
namespace ArtLibs;

use Symfony\Component\HttpFoundation\Request;

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

    function __construct()
    {
        $this->error_manager = $this->setErrorManager(false);

        try {
            /* Set all configurations */
            $this->conf = $this->setConf(false);
            $this->conf_manager = $this->setConfManager(false);

            if ($this->conf_manager->getDevelopmentMode()) {
                error_reporting(E_ALL ^ E_NOTICE);
                ini_set('display_errors', 1);
                error_reporting(~0);
            }

            /* Load all libraries */
            $this->conf_manager->loadLibrary('../ArtLibs');
            $this->conf_manager->loadLibrary('../App/controller');

            if(file_exists($this->conf_manager->getPath() . '/vendor/autoload.php')) {
                require_once($this->conf_manager->getPath() . '/vendor/autoload.php');
                $this->request = Request::createFromGlobals();
            }
            else {
                $this->getErrorManager()->addMessage('The vendor library is missing, use composer to install');
                return;
            }

            /* If all libraries are not loaded successfully then set object */

            $this->data_manager = $this->setDataManager();

            if($this->data_manager->getMessage() != false) {
                $this->getErrorManager()->addMessage('Exception occurred : ' . $this->data_manager->getMessage());
            }

            $this->routes = $this->setRoutes(false);
            $this->route_manager = $this->setRouteManager(false);
            $this->template_manager = $this->setTemplateManager(false);

        }
        catch(\Exception $ex) {
            $this->getErrorManager()->addMessage('Exception occurred : ' .  $ex->getMessage());
        }
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
     * @return mixed
     */
    public function setDataManager($data_manager=null)
    {
        $this->data_manager = new DataManager($this->getConfManager());
        return $this->data_manager;
    }

    /**
     * @return mixed
     */
    public function getRouteManager()
    {
        if(!isset($this->route_manager)) {
            $this->getErrorManager()->addMessage('Route manager is not allocated.');
            exit;
        }
        return $this->route_manager;
    }

    /**
     * @param mixed $route_manager
     * @return mixed
     */
    public function setRouteManager($route_manager=false)
    {
        $this->route_manager = $route_manager;

        if($this->route_manager == false) {
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
     * @param mixed $template_data
     */
    public function setTemplateData($template_data)
    {
        if(count($this->getTemplateData()) < 1) {
            $this->template_data = array(
                'path' => $this->getConfManager()->getPath(),
                'path_static' => $this->getConfManager()->getPathStatic(),
                'path_url' => $this->getConfManager()->getPathUrl(),
                'path_url_postfix' => $this->getConfManager()->getPathUrl() . $this->getConfManager()->getPathRootPostfix(),
                'errors' => $this->getErrorManager()->getMessages(),
                'user_var' => $this->getConfManager()->getUserVar(),
            );
        }

        foreach($template_data as $key => $val) {
            $this->template_data[$key] = $val;
        }
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
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getConfManager()
    {
        return $this->conf_manager;
    }

    /**
     * @param mixed $conf_manager
     * @return mixed
     */
    public function setConfManager($conf_manager=false)
    {
        $this->conf_manager = $conf_manager;

        if($this->conf_manager == false) {
            require_once('Configuration.php');
            $this->conf_manager = new Configuration($this);
            $this->conf_manager = $this->conf_manager->setConfiguration($this->conf);
        }

        return $this->conf_manager;
    }

    /**
     * @return mixed
     */
    public function getErrorManager()
    {
        return $this->error_manager;
    }

    /**
     * @param mixed $error_manager
     * @return mixed
     */
    public function setErrorManager($error_manager=false)
    {
        $this->error_manager = $error_manager;

        if($this->error_manager == false) {
            require_once('ErrorManager.php');
            $this->error_manager = new ErrorManager();
        }

        return $this->error_manager;
    }

    /**
     * @return mixed
     */
    public function getConf()
    {
        return $this->conf;
    }

    /**
     * @param mixed $conf
     * @return mixed
     * @throws \Exception
     */
    public function setConf($conf=false)
    {
        $this->conf = $conf;

        if($this->conf == false) {
            $this->conf = include_once('../conf.php');
        }

        if($this->conf == false) {
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
     * @param mixed $routes
     * @return mixed $routes
     * @throws \Exception
     */
    public function setRoutes($routes=false)
    {
        $this->routes = $routes;

        if($this->routes == false) {
            $this->routes = include('../routes.php');
        }

        if($this->routes == false) {
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
     * @param mixed $template_manager
     * @return mixed
     */
    public function setTemplateManager($template_manager=false)
    {
        $this->template_manager = $template_manager;

        if($this->template_manager == false) {
            $this->template_manager = new TemplateManager($this);
        }
        return $this->template_manager;
    }
}


/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
