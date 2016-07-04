<?php

/**
 * Created by PhpStorm.
 * User: kalen
 * Date: 7/3/16
 * Time: 9:12 PM
 */
namespace Core;
include BASE_DIR . '/app/config/route.php';
include BASE_DIR . '/app/config/config.php';
include BASE_DIR . '/core/Controller.php';
include BASE_DIR . '/core/Model.php';

class Router
{
    private $request_uri;

    private function load_all()
    {
        $dirs =  [
            BASE_DIR . '/app/ext/',
            BASE_DIR . '/app/model/',
            BASE_DIR . '/app/controller/',
        ];

        foreach ($dirs as $dir){
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if( substr(strrchr($file, '.'), 1) == 'php'){
                            include $dir . $file;
                        }
                    }
                    closedir($dh);
                }
            }
        }

    }

    public function __construct()
    {
        $this->load_all();
        $this->request_uri = $_SERVER['REQUEST_URI'];
        $this->request_uri = ltrim($this->request_uri, BASE_URI);
        $this->request_uri = trim($this->request_uri, '/');
        $this->request_uri = ltrim($this->request_uri, 'index.php');
        $this->request_uri .= '/';
    }
    
    public function start()
    {

        $controller_map = DEFAULT_CONTROLLER_MAP;
        $action_name = 'index';
        $routes = explode('/', explode('?', $this->request_uri)[0]);
        if (!empty($routes[1]))
        {
            $controller_map = $routes[1];
        }

        if (!empty($routes[2]))
        {
            $action_name = $routes[2];
        }

        global $controller_route;
        if (!array_key_exists($controller_map, $controller_route))
        {
            $this->render_404();
        }

        $controller = new $controller_route[$controller_map];
        if(method_exists($controller, $action_name))
        {
            $controller->$action_name();
        }
        else
        {
            $this->render_404();
        }

    }
    
    private function render_404()
    {
        header('HTTP/1.1 404 Not Found');
        include BASE_DIR . '/app/views/404.php';
        die();
    }

}