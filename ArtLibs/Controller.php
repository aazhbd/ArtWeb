<?php

namespace ArtLibs;

use Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;


class Controller
{

    private $response;

    /**
     * Controller constructor.
     */
    function __construct()
    {
    }

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

    /**
     * @param array $data
     */
    public function jsonResponse($data = array())
    {
        $this->response = new JsonResponse();
        $this->response->setData($data);
        $this->response->send();
    }


    /**
     * @param Application $app
     * @param $filePath
     * @param bool $download
     * @param string $media
     */
    public function fileResponse(Application $app, $filePath, $download = true, $media = "")
    {
        if (!file_exists($filePath)) {
            $app->getErrorManager()
                ->addMessage("Error Occurred: File could not be found to make a proper response.");
            return;
        }

        $content = file_get_contents($filePath);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        if ($download) {
            header("Content-Type: application/force-download");
            header("Content-Type: application/download");
            header('Content-Disposition: attachment; filename=' . basename($filePath));
        }

        if ($media == "") {
            header("Content-Type: application/octet-stream");
        } else {
            header("Content-Type: " . $media);
        }
        header("Content-Transfer-Encoding: binary");
        echo $content;
        return;
    }

    /**
     * @param Application $app
     * @param $template
     */
    public function display(Application $app, $template)
    {
        $this->response = new Response(
            $app->getTemplateManager()
                ->getTemplate()
                ->render(
                    $app->getConfManager()->getPathUserTemplate() . '/' . $template,
                    $app->getTemplateData()
                ),
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );
        $this->response->send();
    }
}



/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2016 ArticulateLogic Labs
 * @license       MIT License
 */
