<?php

namespace ArtLibs;

class Configuration
{
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

    protected $path_sys_template;

    protected $path_user_template;

    protected $development_mode;

    protected $user_var;

    private $app;

    private $conf;

    /**
     * Configuration constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->path = str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__) . '/..'));

        $this->path_root_postfix = '/';

        $this->path_root = $this->setPathRoot();

        $this->path_url = (
            empty($_SERVER['HTTPS']) ?
                'http://' : 'https://'
            ) .
            $_SERVER['HTTP_HOST'] .
            (
            strlen($this->path_root) ?
                ("/" . $this->getPathRoot()) : ''
            );

        $this->path_sys_template = '/Template/base.twig';
        $this->path_user_template = '/App/views/';

        $this->path_library = $this->path . '/ArtLibs/';
        $this->path_template = $this->getPathSysTemplate();
        $this->path_static = $this->getPathUrl() . '/Template/static/';

        $this->db_host = 'localhost';
        $this->db_name = 'artcms';
        $this->db_user = 'root';
        $this->db_pass = '';

        $this->development_mode = false;

        $this->user_var = array(
            'project_name' => 'ArtWeb'
        );

        $this->app = $app;
        $this->conf = $app->getConf();
    }

    /**
     * @return mixed
     */
    public function getPathRoot()
    {
        return $this->path_root;
    }

    /**
     * @param null $path_root
     * @return mixed|null
     */
    public function setPathRoot($path_root = null)
    {
        if (!isset($path_root)) {
            $this->path_root = str_replace(
                ' ',
                '%20',
                preg_replace(
                    '/' . preg_quote(
                        str_replace(
                            DIRECTORY_SEPARATOR,
                            '/',
                            $_SERVER['DOCUMENT_ROOT']
                        ),
                        '/') . '\/?/',
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
        } else {
            $this->path_root = $path_root;
        }
        return $this->path_root;
    }

    /**
     * @return mixed
     */
    public function getPathSysTemplate()
    {
        return $this->path_sys_template;
    }

    /**
     * @param mixed $path_sys_template
     */
    public function setPathSysTemplate($path_sys_template)
    {
        $this->path_sys_template = $path_sys_template;
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
     * @param $library
     * @return Configuration
     */
    public function loadLibrary($library)
    {
        if (!is_dir($library)) {
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

    /**
     * @param array $conf
     * @return $this
     */
    public function setConfiguration($conf = array())
    {
        if (empty($conf)) {
            return null;
        }

        if (isset($conf['path'])) $this->path = $conf['path'];
        if (isset($conf['path_root'])) $this->path_root = $conf['path_root'];
        if (isset($conf['path_root_postfix'])) $this->path_root_postfix = $conf['path_root_postfix'];
        if (isset($conf['path_url'])) $this->path_url = $conf['path_url'];

        if (isset($conf['path_template'])) $this->path_template = $conf['path_template'];
        if (isset($conf['path_static'])) $this->path_static = $this->getPathUrl() . $conf['path_static'];
        if (isset($conf['path_library'])) $this->path_library = $conf['path_library'];

        if (isset($conf['db_host'])) $this->db_host = $conf['db_host'];
        if (isset($conf['db_name'])) $this->db_name = $conf['db_name'];
        if (isset($conf['db_user'])) $this->db_user = $conf['db_user'];
        if (isset($conf['db_pass'])) $this->db_pass = $conf['db_pass'];

        if (isset($conf['path_sys_template'])) $this->path_sys_template = $conf['path_sys_template'];
        if (isset($conf['path_user_template'])) $this->path_user_template = $conf['path_user_template'];

        if (isset($conf['user_var'])) $this->user_var = $conf['user_var'];

        if (isset($conf['development_mode'])) $this->development_mode = $conf['development_mode'];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPathUserTemplate()
    {
        return $this->path_user_template;
    }

    /**
     * @param mixed $path_user_template
     */
    public function setPathUserTemplate($path_user_template)
    {
        $this->path_user_template = $path_user_template;
    }

    /**
     * @return mixed
     */
    public function getUserVar()
    {
        return $this->user_var;
    }

    /**
     * @param mixed $user_var
     */
    public function setUserVar($user_var)
    {
        $this->user_var = $user_var;
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
     * @param Application $app
     * @return $this
     */
    public function setApp(Application $app)
    {
        $this->app = $app;
        return $this;
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
 * @author        articulatedlogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 articulatedlogic Labs
 * @license       MIT License
 */
