<?php
namespace app\controllers;

use app\engine\Render;
use app\engine\App;

class Controller
{
    private $action;
    private $defaultAction = 'index';
    public $rend;

    public function __construct()
    {
        $this->rend = new Render();
    }

    public function runAction($action = null) {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        }
    }
}