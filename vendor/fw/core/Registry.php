<?php

namespace fw\core;


use fw\core\traits\TSingleton;

class Registry
{
    use TSingleton;

    public static $objects = [];
//    protected static $instance;

    private function __construct()
    {
        $config = require_once ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
    }

    /**
     * magic __get:
     * call undefined method, then
     * we get object of $name.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    /**
     * magic __set:
     * we rec a new object to our container
     * of all objects.
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if ( ! isset(self::$objects[$name])) {
            self::$objects[$name] = new $value;
        }
    }

//    /**
//     * get instance of self.
//     *
//     * @return Registry
//     */
////    public static function getInstance()
////    {
////        if (self::$instance === NULL) {
////            self::$instance = new self;
////        }
////
////        return self::$instance;
////    }


    /**
     * get list of all objects in registry.
     *
     */
    public function getListOfObjects()
    {
        echo '<pre>';
        var_dump(self::$objects);
        echo '</pre>';
    }

}