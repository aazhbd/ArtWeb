<?php
namespace ArtLibs;

class TemplateManager
{
    private $template;

    /**
     * TemplateManager constructor.
     * @param Application $app
     */
    function __construct(Application $app)
    {
        $this->template = new \Twig_Environment(
            new \Twig_Loader_Filesystem($app->getConfManager()->getPath()),
            array('debug' => $app->getConfManager()->getDevelopmentMode())
        );
        $this->template->addGlobal("session", $app->getSession());
    }

    /**
     * @return \Twig_Environment
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}



/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2016 ArticulateLogic Labs
 * @license       MIT License
 */
