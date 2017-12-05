<?php


namespace app\controllers\admin;

use app\models\User;
use fw\core\base\View;
use fw\libs\Helper;
use R;

class UserController extends AppController
{
    public  $layout = 'admin';

    /**
     * отображение главной(таблица с пользователями).
     */
    public function indexAction()
    {
        if(!isset($_SESSION['user_data']) || $_SESSION['user_data']['role'] != 'admin' || $_SESSION['user_data']['role'] == '') {
            Helper::redirect('/');
        }

        // сортировка (login, name, role)
        if(isset($_GET['order'])) {
            $order = Helper::cleanStrData($_GET['order']);
        } else {
            $order = 'role';
        }

        if(isset($_GET['sort'])) {
            $sort = Helper::cleanStrData($_GET['sort']);
        } else {
            $sort = 'ASC';
        }


        // устанавливаем мета.
        View::setMeta('Index title admin', 'some description use in admin', 'keywords');

        //получаем все записи.
        $users = \R::findAll('user', " ORDER BY {$order} $sort");

        // устанавливаем обратную сортировку.
        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';

        // передаем переменную в вид
        $this->set( compact('users', 'sort', 'order'));
    }


    /**
     * удаление пользователя.
     */
    public function deleteAction()
    {
        if(isset($_GET['id'])) {
            $id = Helper::cleanStrData($_GET['id']);
            $user = $this->getUserById($id);

            $res = R::trash( $user, [$id] );
            $_SESSION['success'] = 'Пользователь успешно удален!';
            Helper::redirect('/admin');
        }

         $this->view = 'test';
    }


    /**
     * добавление пользователя.
     */
    public function addAction()
    {
        if( ! empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);

            if(!$user->validate($data, $user->rules) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_register_data'] = $data;
                Helper::redirect();
            }

            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);

            if($user->save('user')) {
                $_SESSION['success'] = 'Пользователь успешно добавлен!';
            } else {
                $_SESSION['errors'] = 'Ошибка при добавлении пользователя!';
            }
            Helper::redirect("/admin");

        }

        View::setMeta('Добавление');
    }


    /**
     * редактируем данные пользователя.
     */
    public function editAction()
    {
        if(isset($_GET['id'])) {
            $id = Helper::cleanStrData($_GET['id']);
            $user = $this->getUserById($id);
            if($user) {
                $this->set(compact('user'));
            }
        }

        if(!empty($_POST)) {
            $userObj = new User();
            $data = $_POST;

            $id = Helper::cleanStrData($_POST['id']);
            $name = Helper::cleanStrData($_POST['name']);
            $role = Helper::cleanStrData($_POST['role']);

            $userObj->load($data);

            if(!$userObj->validate($data, $userObj->rules2) /*|| !$userObj->checkUnique() */) {
                $userObj->getErrors();
                $_SESSION['form_register_data'] = $data;
                Helper::redirect();
            }

           $res = \R::exec("UPDATE user SET role = '$role', name = '$name' WHERE id = :user_id", [':user_id' => $id]);
            var_dump($res);

            if($res) {
                $_SESSION['success'] = 'Данные успешно отредактированы!';
            } else {
                $_SESSION['errors'] = 'Ошибка при редактировании или Вы ничего не меняли!';
            }
            Helper::redirect('/admin');
        }
    }


    /**
     * @param $id
     * @return bool|\RedBeanPHP\OODBBean
     */
    public function getUserById($id)
    {
        $user = R::findOne('user', "id = ?", [$id]);
        if($user) {
            return $user;
        } else {
            return false;
        }
    }
}

