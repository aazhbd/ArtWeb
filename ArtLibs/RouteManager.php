<?php
namespace ArtLibs;

class RouteManager
{
    private $app;

    private $incoming_url;

    private $url_params;

    private $routes;

    function __construct($app)
    {
        $this->app = $app;
        $this->routes = $app->getRoutes();
        $this->incoming_url = $app->getRequest()->getPathInfo();
    }

    public function dispatchUrl($route_conf = array())
    {
        $this->setUrlParams();

        if (count($route_conf) >= 1) {
            $this->setRoutes($route_conf);
        }

        $params = $this->getUrlParams();
        $incoming = $this->getIncomingUrl();
        $routes = $this->getRoutes();

        $ctr_str = "";
        $url_vars = $params;
        $found = false;

        foreach ($routes as $key => $val) {
            $pattern = '/^' . str_replace('/', '\/', $key) . '\/?$/i';

            if (preg_match($pattern, strtolower($incoming), $matches)) {
                $found = true;
                $ctr_str = $val;

                foreach ($matches as $k => $v) {
                    $url_vars[$k] = $v;
                }

                break;
            }
        }

        if (!$found) {
            $this->getApp()->getErrorManager()->addMessage("URL " . $incoming . " not found. 404");
            return;
        }

        $ctr_set = array_values(array_filter(explode('/', trim($ctr_str))));

        $class = str_replace("/", "\\", implode("/", array_slice($ctr_set, 1, 1)));
        $method = implode("/", array_slice($ctr_set, -1, 1));

        if (!method_exists($class, $method)) {
            $this->getApp()->getErrorManager()->addMessage("Method " . $method . " in class " . $class . " couldn't be found");
            return;
        }

        call_user_func_array(array(new $class(), $method), array($url_vars, $this->app));
    }

    /**
     * @return mixed
     */
    public function getUrlParams()
    {
        return $this->url_params;
    }

    /**
     * @param mixed $url_params
     * @return mixed
     */
    public function setUrlParams($url_params = array())
    {
        if (count($url_params) < 1) {
            $this->url_params = array_values(
                array_filter(
                    explode('/', trim($this->incoming_url, '\\'))
                )
            );
        } else {
            $this->url_params = $url_params;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIncomingUrl()
    {
        return $this->incoming_url;
    }

    /**
     * @param mixed $incoming_url
     * @returns mixed
     */
    public function setIncomingUrl($incoming_url = null)
    {
        if ($incoming_url != null) {
            $this->incoming_url = $incoming_url;
        }

        return $this;
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
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

}



/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
