<?php

namespace app\model\repositories;

use app\model\Repository;
use app\engine\Db;
use app\model\entities\User;

class UserRepo extends Repository
{
    public function getTableName() {
        return 'users';
    }

    public function isAuth() {
        return isset($_SESSION['login']);
    }

    public function auth($login, $pass) {

        $user=$this->getWhere('login', $login);

        if (password_verify($pass, $user->hash)) {
//            $_SESSION['login'] = $user->login;
//            $_SESSION['id'] = $user->id;
//            $_SESSION['name'] = $user->name;
//            $_SESSION['surname'] = $user->surname;
//            $_SESSION['email'] = $user->email;
//            $_SESSION['phone'] = $user->phone;
//            $_SESSION['address'] = $user->address;
//            setcookie('hash', uniqid(rand(), true), time() + 3600, '/');
            $this->saveUser($user);
            return $user;
        } else {
            return false;
        }
    }

    protected function getEntityClass()
    {
        return User::class;
    }

    public function saveUser($user) {
        $_SESSION['login'] = $user->login;
        $_SESSION['name'] = $user->name;
        $_SESSION['id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['surname'] = $user->surname;
        $_SESSION['email'] = $user->email;
        $_SESSION['phone'] = $user->phone;
        $_SESSION['address'] = $user->address;
        setcookie('hash', uniqid(rand(), true), time() + 3600, '/');
    }
}
