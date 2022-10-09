<?php
namespace app\traits;

trait TSingletone
{
    private static $instance = null;

    private function  __construct() {}
    private function  __clone() {}
    //private function  __wakeup() {} // Запретить создание экземпляра подключения (3 варианта создания объектов)

    /**
     * @return static
     */
    public static function getInstance() {
        if (is_null(static::$instance)) {
            static::$instance = new static(); // new static()= new App()
        }
        return static::$instance; // возвращает экземпляр класса c подключением
    }
}
