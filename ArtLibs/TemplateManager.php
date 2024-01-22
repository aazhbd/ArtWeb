<?php
namespace ArtLibs;

use \Twig\Environment;

class TemplateManager
{
    private $template;

    /**
     * TemplateManager constructor.
     * @param Application $app
     */
    function __construct(Application $app)
    {
        $this->template = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader($app->getConfManager()->getPath()),
            array('debug' => $app->getConfManager()->getDevelopmentMode())
        );
        $this->template->addGlobal("session", $app->getSession());
    }

    /**
     * @return \Twig\Environment
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param \Twig\Environment $template
     */
    public function setTemplate(\Twig\Environment $template)
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
