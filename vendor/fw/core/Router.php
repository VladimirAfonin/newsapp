<?php

namespace fw\core;

use fw\libs\Helper;

class Router
{
    protected static $routes = [];
    protected static $route = [];

    /**
     * add route.
     *
     * @param $regexp
     * @param array $route
     */
    public static function addRoute($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * helper function.
     *
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * get single route.
     *
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }


    /**
     * take url and set it to current url.
     *
     * @param $url
     * @return bool
     */
    protected static function matchRoute($url)
    {
        foreach (self::$routes as $regexp => $value) {
            if (preg_match("#$regexp#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $value[$k] = $v;
                    }
                }
                if ( ! in_array($value['action'], $value)) $value['action'] = 'index';

                // prefix for admin controllers.
                if( ! isset($value['prefix']) ) {
                    $value['prefix'] = '';
                } else {
                    $value['prefix'] .= '\\';
                }

                $value['controller'] = Helper::getCamelCaseName($value['controller']);
                self::$route = $value;
                return TRUE;
            }
        }

        return FALSE;
    }


    /**
     * dispatch method in controller.
     *
     * @param $url
     * @throws \Exception
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
//            Helper::debug(self::$route);
            $controller = 'app\controllers\\' . self::$route['prefix'] . Helper::getCamelCaseName(self::$route['controller']) . 'Controller';

            if (class_exists($controller)) {
                $controllerObj = new $controller(self::$route);
                $action = Helper::getLowerCaseName( self::$route['action'] ) . 'Action';
                if(method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->getView();
                } else  {
                    // echo 'Method not found';
                    throw new \Exception('Method not found', 404);
                }
            } else {
                //echo 'Class not found';
                throw new \Exception('Class not found - ' . ($controller) , 404);
            }

        } else {
//            http_response_code(404);
//            include '404.html';
            throw new \Exception( 'page not found' );
        }
    }

    /**
     * @param $url
     * @return string
     */
    protected static function removeQueryString($url)
    {
        if($url) {
            $params = explode('&', $url, 2);
            if( FALSE === strpos($params[0], '=') ) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }


}