<?php

class Autoload
{
    public function loadClass($className) {

        $arr = explode("\\", $className);
        $arr[0] = '..';
        $className = implode("/", $arr);
        $fileName = "{$className}.php";

        include $fileName;
    }
}