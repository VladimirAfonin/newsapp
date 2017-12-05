<?php

define("DEBUG", TRUE);

//class NotFoundException extends Exception
//{
//    public function __construct($message = "", $code = 404, Exception $previous = null)
//    {
//        parent::__construct($message, $code, $previous);
//    }
//}

class ErrorHandler
{
    public function __construct()
    {
        if(DEBUG) {
            error_reporting(-1);
            ini_set('display_errors', 1);
        } else {
            error_reporting(0);
        }
        // set our error handler.
        set_error_handler([$this, 'errorHandler']);


        // set our error fatal handler.
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);

        // set our exception handler.
        set_exception_handler([$this, 'exceptionHandler']);
    }

    /**
     * my custom handler.
     *
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @return bool
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        error_log("[" . date('Y-m-d h:i:s') . "] text of error: {$errstr} | File: {$errfile} | String: {$errline}\n============ next ->\n", 3, __DIR__ . '/errors.log');
        $this->displayError($errno, $errstr, $errfile, $errline);
        return TRUE;
    }

    /**
     * display custom template with all errors.
     *
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @param int $response
     */
    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        http_response_code($response);
        if(DEBUG) {
            require_once 'views/dev.php';
        } else {
            require_once 'views/prod.php';
        }
        die();
    }

    /**
     * our fatal Error handler.
     *
     */
    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if( ! empty($error) && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR ) ) {
            error_log("[" . date('Y-m-d h:i:s') . "] text of error: {$error['message']} | File: {$error['file']} | String: {{$error['line']}\n============ next ->\n", 3, __DIR__ . '/errors.log');
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line'] );
        } else {
            ob_end_flush();
        }
    }

    /**
     * our exception handler.
     *
     * @param Exception $e
     */
    public function exceptionHandler($e)
    {
//        var_dump($e->getCode());
        error_log("[" . date('Y-m-d h:i:s') . "] text of error: {$e->getMessage()} | File: {$e->getFile()} | String: {$e->getLine()}\n============ next ->\n", 3, __DIR__ . '/errors.log');
        $this->displayError('exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }



}

new ErrorHandler();

//echo  $test;
test();
//try{
//    if(empty($test)) {
//        throw new Exception('ooops');
//    }
//} catch (Exception $e) {
////    var_dump($e);
//    $e->getMessage();
//}

//throw new Exception('ooops', 404);
//throw new NotFoundException();