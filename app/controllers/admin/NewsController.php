<?php

namespace app\controllers\admin;

use app\models\News;
use fw\core\base\View;
use fw\libs\Helper;
use R;

class NewsController extends AppController
{
    public  $layout = 'admin';

    /**
     * отображение новостей.
     */
    public function indexAction()
    {
        if(!isset($_SESSION['user_data']) || $_SESSION['user_data']['role'] != 'admin' || $_SESSION['user_data']['role'] == '') {
            Helper::redirect('/');
        }

        // устанавливаем мета.
        View::setMeta('Index title admin', 'some description use in admin', 'keywords');

        //получаем все записи.
        $news = \R::findAll('news');

        // передаем переменную в вид
        $this->set( compact('news'));
    }


    /**
     * удаление новости.
     */
    public function deleteAction()
    {
        if(isset($_GET['id'])) {
            $id = Helper::cleanStrData($_GET['id']);
            $news = $this->getNewsById($id);

            R::trash( $news, [$id] );
            $_SESSION['success'] = 'Новость успешно удалена!';
            Helper::redirect('/admin/news/index');
        }

        $this->view = '';
    }


    /**
     * добавление новости.
     */
    public function addAction()
    {
        if( ! empty($_POST)) {
            $news = new News();
            $data = $_POST;
            $news->load($data);

            if(!$news->validate($data, $news->rules)) {
                $news->getErrors();
                $_SESSION['form_register_data'] = $data;
                Helper::redirect();
            }

            if($news->save('news')) {
                $_SESSION['success'] = 'Новость успешно добавлена!';
            } else {
                $_SESSION['errors'] = 'Ошибка при добавлении новости!';
            }
            Helper::redirect("/admin/news/index");

        }

        View::setMeta('Добавление новости');
    }


    /**
     * редактируем новость.
     */
    public function editAction()
    {
        if(isset($_GET['id'])) {
            $id = Helper::cleanStrData($_GET['id']);
            $news = $this->getNewsById($id);
            if($news) {
                $this->set(compact('news'));
            }
        }

        if(!empty($_POST)) {
            $newsObj = new News();
            $data = $_POST;

            $text = Helper::cleanStrData($_POST['text']);
            $id = Helper::cleanStrData($_POST['id']);

            $newsObj->load($data);

            if(!$newsObj->validate($data, $newsObj->rules)) {
                $newsObj->getErrors();
                $_SESSION['form_register_data'] = $data;
                Helper::redirect();
            }

            $res = \R::exec("UPDATE news SET text = '$text' WHERE id = :news_id", [':news_id' => $id]);

            if($res) {
                $_SESSION['success'] = 'Данные успешно отредактированы!';
            } else {
                $_SESSION['errors'] = 'Ошибка при редактировании или Вы ничего не меняли!';
            }
            Helper::redirect('/admin/news/index');
        }
    }


    /**
     * получаем новость по $id
     *
     * @param $id
     * @return bool|\RedBeanPHP\OODBBean
     */
    public function getNewsById($id)
    {
        $news = R::findOne('news', "id = ?", [$id]);
        if($news) {
            return $news;
        } else {
            return false;
        }
    }
}

