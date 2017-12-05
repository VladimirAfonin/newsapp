<?php

namespace app\controllers;

use app\models\Main;
use fw\core\base\Controller;
use R;

class AppController extends Controller
{
    public $menu;
    public $meta = [];

    public function __construct(array $route = [])
    {
        parent::__construct($route);
        new Main();
//        $this->menu = R::findAll('categories');
    }

    protected function setMeta($title = '', $description = '', $keywords)
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }
}