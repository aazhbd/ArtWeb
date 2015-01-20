<?php
namespace ArtLibs;

class TemplateManager
{
    private $template;

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    function __construct($app)
    {
        $this->template = new \Twig_Environment(
            new \Twig_Loader_Filesystem(
                    $app->getConfManager()->getPathTemplate(),
                    array('debug' => $app->getConfManager()->getDevelopmentMode()
                )
            )
        );
    }
}



/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
