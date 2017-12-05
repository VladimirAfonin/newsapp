<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//
//
// $config = [
//    'components' => [
//        'cache' => 'classes\Cache',
//        'test' => 'classes\Test',
//    ]
//];
//
//spl_autoload_register(function($class) {
//    $file = str_replace( '\\', '/', $class ) . '.php';
//    if( is_file($file) ) {
//        require_once $file;
//    }
//});
//
//
//
//class Registry
//{
//    public static $objects = [];
//    protected static $instance;
//
//    private function __construct()
//    {
//        global $config;
//        foreach($config['components'] as $name => $component) {
//            self::$objects[$name] = new $component;
//        }
//    }
//
//    /**
//     * magic __get:
//     * call undefined method, then
//     * we get object of $name.
//     *
//     * @param $name
//     * @return mixed
//     */
//    public function __get($name)
//    {
//        if(is_object(self::$objects[$name])) {
//            return  self::$objects[$name];
//        }
//    }
//
//    /**
//     * magic __set:
//     * we rec a new object to our container
//     * of all objects.
//     *
//     * @param $name
//     * @param $value
//     */
//    public function __set($name, $value)
//    {
//        if( ! isset(self::$objects[$name])) {
//            self::$objects[$name] = new $value;
//        }
//    }
//
//    /**
//     * get instance of self.
//     *
//     * @return Registry
//     */
//    public static function getInstance()
//    {
//        if(self::$instance === NULL) {
//            self::$instance = new self;
//        }
//
//        return self::$instance;
//    }
//
//    public function getListOfObjects()
//    {
//        echo '<pre>';
//        var_dump(self::$objects);
//        echo '</pre>';
//    }
//}
//
////$cache = new Cache();
////echo "hello world";
//$app = Registry::getInstance();
//$app->test->go();
//$app->test2 = 'classes\Test2';
////var_dump($test);
//$app->getListOfObjects();
//$app->test2->hello();
////$a = 2;
////echo $a;