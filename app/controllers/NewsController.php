<?php

namespace app\controllers;

use fw\libs\Helper;

class NewsController extends AppController
{

    /**
     * данные по новости.
     */
    public function oneAction()
    {
        if(isset($_GET['id'])) {
            $id = Helper::cleanStrData($_GET['id']);
            $news = $this->getNewsById($id);
            if($news) {
                $this->set(compact('news'));
            }
        }
    }

    /**
     * получаем отдельную новость
     *
     * @param $id
     * @return bool|\RedBeanPHP\OODBBean
     */
    public function getNewsById($id)
    {
        $news = \R::findOne('news', "id = ?", [$id]);
        if ($news) {
            return $news;
        } else {
            return false;
        }
    }
}