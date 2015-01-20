<?php

namespace ArtLibs;

use \Symfony\Component\HttpFoundation\Response;


class Controller {

    private $response;

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    function __construct()
    {

    }

    public function display($app, $template)
    {
        $this->response = new Response($app->getTemplateManager()->getTemplate()->render($template, $app->getTemplateData()), Response::HTTP_OK, array('content-type' => 'text/html'));
        $this->response->send();

    }
}



/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
