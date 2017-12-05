<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
//error_reporting(-1); // e-all

use fw\core\App;
use fw\core\Router;
//use fw\libs\Helper;


// directory separator.
define('DS', DIRECTORY_SEPARATOR);

// public folder.
define('WWW', __DIR__);

// core folder.
define('CORE', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DS . 'fw'  . DS . 'core');


// root dir.
define('ROOT', dirname(__DIR__));

// app dir.
define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app');

// view dir.
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views');

// view/layout dir.
define('LAYOUTS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts');

// libs folder.
define('LIBS', dirname(__DIR__) . DS . 'vendor' . DS . 'fw' . DS . 'libs');
//var_dump(LIBS); exit();

// cache folder.
define('CACHE_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'cache' );

// tmp folder.
define('TEMP_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR);

// DEBUG.
define('DEBUG',  TRUE);



//echo VIEWS;


$query = rtrim($_SERVER['QUERY_STRING'], '/');

//require '../vendor/core/Router.php';
//require '../vendor/libs/Helper.php';
//require  '../app/controllers/Posts.php';
//require  '../app/controllers/Main.php';
//require  '../app/controllers/PostsNew.php';
require_once __DIR__ . '/../vendor/autoload.php';

/*
spl_autoload_register(function($class) {
    $file = ROOT . DIRECTORY_SEPARATOR . str_replace( '\\', '/', $class ) . '.php';
    if( is_file($file) ) {
        require_once $file;
    }
});
*/

//Router::addRoute('posts/add', ['controller' => 'Posts', 'action' => 'add']);
//Router::addRoute('posts', ['controller' => 'Posts', 'action' => 'index']);
//Router::addRoute('', ['controller' => 'Main', 'action' => 'index']);

// our route rules.

// create App instance.
//new fw\core\App();
new App;

// default route rules.
Router::addRoute('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::addRoute('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// admin routes rules.
Router::addRoute('^admin$', ['controller' => 'User', 'action' => 'index', 'prefix' => 'admin']);
Router::addRoute('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

Router::addRoute("^$", ['controller' => 'Main', 'action' => 'index']);
Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');



//Helper::debug(Router::getRoutes());

//if(Router::matchRoute($query)) {
//    Helper::debug(Router::getRoute());
//} else {
//    echo '404';
//}

//echo "<br>" . Helper::getRightControllerName('posts-new') . "<br>";
//echo "<br>" . Helper::getLowerCaseName('posts-newer') . "<br>";
//echo APP;

Router::dispatch($query);
