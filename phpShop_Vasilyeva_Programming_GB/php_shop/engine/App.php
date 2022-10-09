<?php

namespace app\engine;

use app\controllers\ProductController;
use app\model\repositories\CartRepo;
use app\model\repositories\ProductRepo;
use app\model\repositories\UserRepo;
use app\model\repositories\OrderRepo;
use app\engine\Session;
use app\traits\TSingletone;

/**
 * Class App
 * @property Request $request
 * @property Db $db
 * @property CartRepo $cartRepo
 * @property ProductRepo $productRepo
 * @property UserRepo $userRepo
 * @property OrderRepo $orderRepo
 * @property Session $session
 *
 */
class App
{
    use TSingletone;

    public $config;
    private $components; //new Storage();
    private $controller;
    private $action;

    public function run($config) {

        $this->config = $config;

        $this->components = new Storage();

        $this->runController();
    }

    public function  runController() {
        $this->controller = $this->request->getControllerName() ?: 'product';

        $this->action = $this->request->getActionName();
        $controllerClass = $this->config['controllers_namespace'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            $controller->runAction($this->action);
        } else
        {
            header("Location: App::call()->request->getPreviousPage()");
            die();
//            echo 'Wrong controller';
//            throw new \Exception ('Wrong controller', 404);
        }
    }

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function createComponent($name) {

        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];

            if (class_exists($class)) {
                unset($params['class']);

                $reflection = new \ReflectionClass($class);

                return $reflection->newInstanceArgs($params);
            }
        }
        return null;
    }

    public function __get($name)
    {
        return $this->components->get($name);
    }
}