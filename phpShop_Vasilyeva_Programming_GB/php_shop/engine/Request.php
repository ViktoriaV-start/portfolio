<?php

namespace app\engine;

class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName = null;

    protected $params;
    protected $method;
    protected $previousPage = null;

    public function __construct()
    {
        $this->parseRequest();
    }

    private function parseRequest() {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);
        $this->controllerName = $url[1];
        if (isset($url[2])) {
            $secondUrlPart = explode('?', $url[2]);
            $this->actionName = $secondUrlPart[0];
        }
        $this->params = $_REQUEST;

        $data = json_decode(file_get_contents('php://input'));
        if (!is_null($data)) {
            foreach ($data as $key => $value) {
                $this->params[$key] = $value;
            }
        }
        $this->previousPage = $_SERVER['HTTP_REFERER'] ?? '';
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {



        return $this->controllerName;

    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    public function getPreviousPage() {
        return $this->previousPage;
    }

}