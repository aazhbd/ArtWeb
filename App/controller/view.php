<?php

use ArtLibs\Controller;

class Views extends Controller
{
    public function viewHome($params, $app)
    {
        $app->setTemplateData(
            array(
                'title' => 'Test',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
            )
        );
        $this->display($app, 'base.twig');
    }

    public function viewCustom($params, $app) {
        $app->setTemplateData(
            array(
                'title' => 'Custom',
                'body_content' => 'A test custom page loaded from controller/view.php.'
            )
        );

        $this->display($app, 'home.twig');
    }
}
