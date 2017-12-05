<?php


namespace fw\core\traits;


trait TSingleton
{
    protected static $instance;


    /**
     * get instance of Object.
     *
     * @return TSingleton
     */
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}