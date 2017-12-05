<?php


namespace fw\core;


use fw\libs\ErrorHandler;


class App
{
    public static $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
        new ErrorHandler();
    }
}