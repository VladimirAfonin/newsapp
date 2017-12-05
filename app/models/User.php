<?php


namespace app\models;


use fw\core\base\Model;
use fw\libs\Helper;

class User extends Model
{
    public $attributes = [
        'login' => '',
        'password' => '',
        'email' => '',
        'name' => '',
        'role' => '',

    ];

    public $rules = [
        'required' => [
            ['login'], ['email'], ['name'], ['password']     // поля.
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ]
    ];

    public $rules2 = [
        'required' => [
             ['name'],     // поля.
        ],
        'email' => [
            ['email'],
        ],
    ];


    /**
     * check unique login and email.
     *
     * @return bool
     */
    public function checkUnique()
    {
        $user = \R::findOne('user', 'login = ? OR email = ? LIMIT 1', [$this->attributes['login'], $this->attributes['email']]);
        if($user) {
            if($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = 'Логин уже занят';
            }
            if($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = 'Email уже занят';
            }
            return false;
        }
        return true;
    }


    /**
     * check unique with excluded id.
     *
     * @param $id
     * @return bool
     */
    public function checkUniqueWithId($id)
    {

        $user = \R::findOne('user', 'login = ? OR email = ? AND id != ? LIMIT 1', [$this->attributes['login'], $this->attributes['email'], $id]);
        if($user) {
            if($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = 'Логин уже занят';
            }
            if($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = 'Email уже занят';
            }
            return false;
        }
        return true;
    }


    /**
     * login user.
     *
     * @return bool
     */
    public function login()
    {
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if($login && $password) {
            $user = \R::findOne('user', 'login = ? LIMIT 1', [$login]);
            if($user) {
                if(password_verify($password, $user->password)) {
                    foreach($user as $k => $v) {
                        if($k != 'password')  {
                            $_SESSION['user_data'][$k] = $v;
                        }
                    }
                    return true;
                } else {
                    unset($_SESSION['user_data']);
                }
            }
        }
        return false;
    }
}