<?php

namespace fw\libs;

class Helper
{
    private static $config;

    private function __construct()
    {
        self::$config = require_once ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
    }


    /**
     * print array of routes.
     *
     * @param $arr
     */
    public static function debug($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    public static function redirect($http = false)
    {
        if($http) {
            $redirect = $http;
        } else {
            $redirect = $_SERVER['HTTP_REFERER'] ?? self::$config['settings']['main_path'];
        }
        header("Location: $redirect");
        exit;
    }

    /**
     * get controller class name.
     *
     * @param $string
     * @return string
     */
    public static function getCamelCaseName( $string )
    {
        return $string = implode( array_map( "ucFirst", explode( '-', $string ) ) );
    }

    /**
     * get lower case name of method.
     *
     * @param $string
     * @return string
     */
    public static function getLowerCaseName($string)
    {
       return lcfirst( self::getCamelCaseName( $string ) );
    }

    /**
     * clean input string from user.
     *
     * @param $str
     * @return string
     */
    public static function cleanStrData($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }

}

