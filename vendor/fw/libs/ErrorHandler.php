<?php


namespace fw\libs;


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
        $this->errorsLog( $errstr, $errfile, $errline );

        if(DEBUG || in_array($errno, [E_USER_ERROR, E_RECOVERABLE_ERROR])) {
            $this->displayError($errno, $errstr, $errfile, $errline);
        }

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
        if( $response == 404 && !DEBUG ) {
            require_once VIEWS . DIRECTORY_SEPARATOR . 'Errors' . DIRECTORY_SEPARATOR . '404.html';
            die();
        }

        if(DEBUG) {
            require_once VIEWS . DIRECTORY_SEPARATOR . 'Errors' . DIRECTORY_SEPARATOR . 'dev.php';
        } else {
            require_once VIEWS . DIRECTORY_SEPARATOR . 'Errors' . DIRECTORY_SEPARATOR . 'prod.php';
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
            $this->errorsLog($error['message'], $error['file'], $error['line']);
            //            error_log("[" . date('Y-m-d h:i:s') . "] text of error: {$error['message']} | File: {$error['file']} | String: {{$error['line']}\n============ next ->\n", 3, __DIR__ . '/errors.log');
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line'] );
        } else {
            ob_end_flush();
        }
    }

    /**
     * our exception handler.
     *
     * @param  $e
     */
    public function exceptionHandler($e)
    {
        $this->errorsLog($e->getMessage(), $e->getFile(), $e->getLine());
//        error_log("[" . date('Y-m-d h:i:s') . "] text of error: {$e->getMessage()} | File: {$e->getFile()} | String: {$e->getLine()}\n============ next ->\n", 3, __DIR__ . '/errors.log');
        $this->displayError('exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    /**
     * write logs to file.
     *
     * @param string $message
     * @param string $file
     * @param string $line
     */
    public function errorsLog($message = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d h:i:s') . "] text of error: {$message} | File: {$file} | String: {$line}\n============ next ->\n", 3, TEMP_DIR . 'errors.log');
    }
}