<?php

namespace app\controllers;

use app\models\Main;
use R;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Helper;

class MainController extends AppController
{
    /**
     * главная страница пользователя.
     */
    public function indexAction()
    {
        if(!isset($_SESSION['user_data'])) {
            Helper::redirect('/user/login');
        }

        $model = new Main();

        $news = R::findAll('news');


        $this->view = 'index';
        $this->layout = 'default';

        // set meta data.
        View::setMeta('Index title', 'some description', 'keywords');

        $this->set(compact('news'));

    }

}