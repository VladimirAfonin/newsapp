<?php


namespace app\controllers;


use app\models\User;
use fw\core\base\View;
use fw\libs\Helper;

class UserController extends AppController
{

    /**
     * sign up user.
     */
    public function signUpAction()
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
                $_SESSION['success'] = 'Вы успешно зарегистрированы, пожалуйста, выполните вход.';
            } else {
                $_SESSION['errors'] = 'Ошибка регистрации!';
            }
            Helper::redirect("/");

        }

        View::setMeta('Registration');
    }


    /**
     * login user.
     */
    public function loginAction()
    {
        if(!empty($_POST)) {
            $user = new User();
            if($user->login()) {
                $_SESSION['success'] = 'Вы успешно авторизованы';
                Helper::redirect('/');
            } else {
                $_SESSION['errors'] = 'Логин/пароль введены неверно';
                Helper::redirect();
            }
        }

        View::setMeta('Registration');
    }

    /**
     * данные по пользователю.
     */
    public function oneAction()
    {
        if(isset($_GET['id'])) {
            $id = Helper::cleanStrData($_GET['id']);
            $user = $this->getUserById($id);
            if($user) {
                $this->set(compact('user'));
            }
        }
    }


    /**
     * редактирование профиля.
     */
    public function editAction()
    {
        $id = $_SESSION['user_data']['id'];
        $user = $this->getUserById($id);

        // старые данные.
        $userEmail = $user['email'];
        $userLogin = $user['login'];


        if( ! empty($_POST)) {
            $user = new User();
            $data = $_POST;

            // получаем данные
            $login = Helper::cleanStrData($_POST['login']);
            $name = Helper::cleanStrData($_POST['name']);
            $email = Helper::cleanStrData($_POST['email']);
            $pass = password_hash( Helper::cleanStrData($_POST['password']), PASSWORD_DEFAULT );

            $user->load($data);


            // проверка на уникальность
            if($userEmail == $email && $userLogin == $login) {
                if(!$user->validate($data, $user->rules)) {
                    $user->getErrors();
                    $_SESSION['form_register_data'] = $data;
                    Helper::redirect();
                }

                $res = \R::exec("UPDATE user SET name = '$name', password = '$pass' WHERE id = :user_id", [':user_id' => $id]);
            } else {
                if(!$user->validate($data, $user->rules) || !$user->checkUniqueWithId($id)) {
                    $user->getErrors();
                    $_SESSION['form_register_data'] = $data;
                    Helper::redirect();
                }

                $res = \R::exec("UPDATE user SET name = '$name', password = '$pass', login = '$login', email = '$email' WHERE id = :user_id", [':user_id' => $id]);
            }


            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);

            if($res) {
                $_SESSION['success'] = 'Данные успешно отредактированы!';
            } else {
                $_SESSION['errors'] = 'Ошибка редактирования!';
            }
            Helper::redirect("/");
        }

        View::setMeta('Registration');

        $this->set(compact('user'));
    }

    /**
     * получить пользователя по id.
     *
     * @param $id
     * @return bool|\RedBeanPHP\OODBBean
     */
    public function getUserById($id)
    {
        $user = \R::findOne('user', "id = ?", [$id]);
        if($user) {
            return $user;
        } else {
            return false;
        }
    }


    /**
     * logout user.
     */
    public function logOutAction()
    {
        if(isset($_SESSION['user_data'])) unset($_SESSION['user_data']);
        Helper::redirect('/user/login');
    }

}