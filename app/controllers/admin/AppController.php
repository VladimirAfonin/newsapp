<?php


namespace app\controllers\admin;

use fw\core\base\Controller;
use app\models\Main;
use R;


class AppController extends Controller
{
    public  $layout = 'admin';

    public function __construct(array $route = [])
    {
        parent::__construct($route);
        new Main();
    }

}