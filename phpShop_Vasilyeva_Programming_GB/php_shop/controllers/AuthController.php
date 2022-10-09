<?php
namespace app\controllers;

use app\model\entities\User;
use app\engine\Request;
use app\model\repositories\UserRepo;
use app\engine\App;

class AuthController extends Controller
{
    public function actionIndex() {
        if (App::call()->userRepo->isAuth()) {
            $user = [
                'login' => App::call()->session->getSession('login'),
                'name' => App::call()->session->getSession('name'),
                'surname' => App::call()->session->getSession('surname'),
                'email' => App::call()->session->getSession('email'),
                'phone' => App::call()->session->getSession('phone'),
                'address' => App::call()->session->getSession('address'),
            ]; 
            echo $this->rend->renderUser((object)$user);
        } else {
            echo $this->rend->renderAuth();
        }
    }

    public function actionAccount($user) {
        echo $this->rend->renderUser($user);
    }

    public function actionLogout() {
        session_destroy();
        setcookie('hash', '', time()-3600, '/');
        header('Location: /product');
        die();
    }

    public function actionLogin() {
        $login = App::call()->request->getParams()['email'];
        $pass = App::call()->request->getParams()['password'];

        if ($user = (new UserRepo())->auth($login, $pass)) {
            $this->actionAccount($user);
        } else {
            die("Incorrect login/password");
        }
    }

    public function actionRegistration() {
        $request = new Request();
        $login = $request->getParams()['email'];
        $name = $request->getParams()['name'];
        $surname = $request->getParams()['surname'];
        $email = $request->getParams()['email'];
        $address = $request->getParams()['address'];
        $phone = $request->getParams()['phone'];
        $pass = $request->getParams()['password'];
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        if(App::call()->userRepo->getWhere('login', $login)) {
            echo "User with this email exists. Log in with password";
        } else {
            $newUser = new User($login, $name, $surname, $email, $phone, $address, $pass, $hash);

            App::call()->userRepo->insert($newUser);

            App::call()->userRepo->saveUser($newUser);

            if (App::call()->cartRepo->getCart()) {
                header('Location: /cart/ordering');
            } else {
                header('Location: /product');
            }
            die();
        }
    }
}














