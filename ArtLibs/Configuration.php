<?php

namespace ArtLibs;

class Configuration
{
    private $app;

    protected $db_host;

    protected $db_name;

    protected $db_user;

    protected $db_pass;

    protected $path;

    protected $path_root;

    protected $path_root_postfix;

    protected $path_url;

    protected $path_template;

    protected $path_static;

    protected $path_library;

    protected $development_mode;

    private $conf;

    public function __construct($app)
    {
        $this->path = str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__).'/..'));

        $this->path_root_postfix = '/webroot';

        $this->path_root = str_replace(
                                ' ',
                                '%20',
                                preg_replace(
                                    '/'.preg_quote(
                                        str_replace(
                                            DIRECTORY_SEPARATOR,
                                            '/',
                                            $_SERVER['DOCUMENT_ROOT']
                                        ),
                                        '/').'\/?/',
                                        '',
                                        str_replace(
                                            DIRECTORY_SEPARATOR,
                                            '/',
                                            realpath(
                                                dirname(__FILE__) . '/..'
                                            )
                                        )
                                )
                            );

        $this->path_url = (
                    empty($_SERVER['HTTPS']) ?
                        'http://' : 'https://'
                    ) .
                    $_SERVER['HTTP_HOST'] .
                    (
                    strlen($this->path_root) ?
                        ("/" . $this->path_root) : ''
                    );

        $this->path_library = $this->path . '/ArtLibs/';
        $this->path_template = $this->path . '/App/template/';
        $this->path_static = $this->path_url . '/App/static/';

        $this->db_host = 'localhost';
        $this->db_name = 'artcms';
        $this->db_user = 'root';
        $this->db_pass = '';

        $this->development_mode = false;

        $this->app = $app;
        $this->conf = $app->getConf();
    }

    /**
     * @return string
     */
    public function getPathRootPostfix()
    {
        return $this->path_root_postfix;
    }

    /**
     * @param string $path_root_postfix
     */
    public function setPathRootPostfix($path_root_postfix)
    {
        $this->path_root_postfix = $path_root_postfix;
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

    /**
     * @return mixed
     */
    public function getDbHost()
    {
        return $this->db_host;
    }

    /**
     * @param mixed $db_host
     */
    public function setDbHost($db_host)
    {
        $this->db_host = $db_host;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @param mixed $db_name
     */
    public function setDbName($db_name)
    {
        $this->db_name = $db_name;
    }

    /**
     * @return mixed
     */
    public function getDbPass()
    {
        return $this->db_pass;
    }

    /**
     * @param mixed $db_pass
     */
    public function setDbPass($db_pass)
    {
        $this->db_pass = $db_pass;
    }

    /**
     * @return mixed
     */
    public function getDbUser()
    {
        return $this->db_user;
    }

    /**
     * @param mixed $db_user
     */
    public function setDbUser($db_user)
    {
        $this->db_user = $db_user;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPathUrl()
    {
        return $this->path_url;
    }

    /**
     * @param mixed $path_url
     */
    public function setPathUrl($path_url)
    {
        $this->path_url = $path_url;
    }

    /**
     * @return mixed
     */
    public function getPathLibrary()
    {
        return $this->path_library;
    }

    /**
     * @param mixed $path_library
     */
    public function setPathLibrary($path_library)
    {
        $this->path_library = $path_library;
    }

    /**
     * @return mixed
     */
    public function getPathRoot()
    {
        return $this->path_root;
    }

    /**
     * @param mixed $path_root
     */
    public function setPathRoot($path_root)
    {
        $this->path_root = $path_root;
    }

    /**
     * @return mixed
     */
    public function getPathStatic()
    {
        return $this->path_static;
    }

    /**
     * @param mixed $path_static
     */
    public function setPathStatic($path_static)
    {
        $this->path_static = $path_static;
    }

    /**
     * @return mixed
     */
    public function getPathTemplate()
    {
        return $this->path_template;
    }

    /**
     * @param mixed $path_template
     */
    public function setPathTemplate($path_template)
    {
        $this->path_template = $path_template;
    }

    /**
     * @return mixed
     */
    public function getDevelopmentMode()
    {
        return $this->development_mode;
    }

    /**
     * @param mixed $development_mode
     */
    public function setDevelopmentMode($development_mode)
    {
        $this->development_mode = $development_mode;
    }

    public function loadLibrary($library)
    {
        if(!is_dir($library)) {
            return false;
        }

        $lib_dir = $library;

        if ($handle = opendir($lib_dir)) {
            while (false !== ($entry = readdir($handle))) {
                if (strpos($entry, '.php')) {
                    require_once($lib_dir . '/' . $entry);
                }
            }
            closedir($handle);
        }

        return $this;
    }

    public function setConfiguration($conf)
    {
        if(count($conf) < 1 || empty($conf)) {
            return false;
        }

        if(isset($conf['path'])) $this->path = $conf['path'];
        if(isset($conf['path_root'])) $this->path_root = $conf['path_root'];
        if(isset($conf['path_root_postfix'])) $this->path_root_postfix = $conf['path_root_postfix'];
        if(isset($conf['path_url'])) $this->path_url = $conf['path_url'];

        if(isset($conf['path_template'])) $this->path_template = $conf['path_template'];
        if(isset($conf['path_static'])) $this->path_static = $conf['path_static'];
        if(isset($conf['path_library'])) $this->path_library = $conf['path_library'];

        if(isset($conf['db_host'])) $this->db_host = $conf['db_host'];
        if(isset($conf['db_name'])) $this->db_name = $conf['db_name'];
        if(isset($conf['db_user'])) $this->db_user = $conf['db_user'];
        if(isset($conf['db_pass'])) $this->db_pass = $conf['db_pass'];

        if(isset($conf['development_mode'])) $this->development_mode = $conf['development_mode'];
        return $this;

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
     */
    public function setConf($conf)
    {
        $this->conf = $conf;
    }
}



/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
