<?php

namespace fw\core\base;


abstract class Controller
{
    public $route;
    public $view;
    public $layout;
    public $vars = [];

    public function __construct($route = [])
    {
        $this->route = $route;
//        $this->view = include VIEWS . DIRECTORY_SEPARATOR . $this->route['controller'] . DIRECTORY_SEPARATOR . $this->route['action'] . '.php';
        $this->view = $route['action'];
    }

    /**
     * рендерим вид.
     *
     */
    public function getView()
    {
        $viewObj = new View($this->route, $this->layout, $this->view);
        $viewObj->render($this->vars);
    }

    /**
     * set data that goes to view.
     *
     * @param $data
     */
    public function set($data)
    {
        $this->vars = $data;
    }

    /**
     * проверяем какой запрос по типу.
     *
     * @return bool
     */
    public function isAjax()
    {
        return isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }


    /**
     * запрашиваем вид.
     *
     * @param $view
     * @param array $vars
     */
    public function loadView($view, $vars = [])
    {
        extract($vars);
        $file_view = VIEWS . DIRECTORY_SEPARATOR . $this->route['controller'] . DIRECTORY_SEPARATOR . $view . '.php';
        require $file_view;
    }
}