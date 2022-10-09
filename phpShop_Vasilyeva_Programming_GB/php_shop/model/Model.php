<?php

namespace app\model;

abstract class Model
{
    protected $props = [];

    public function __set($name, $value) {
        $this->$name = $value;
        $this->props[$name] = true;
    }

    public function __get($name) {
        return $this->$name;
    }

    // ЭТОТ МЕТОД ОЧЕНЬ ВАЖЕН ДЛЯ РЕНДЕРА ОТДЕЛЬНО КАРТОЧКИ ТОВАРА Card,
    // сюда передается объект. А в нашем отдельном объекте (экземпляр класса, например,
    // Product) мы закрыли поля (они protected). А twig не сможет достать данные из закрытых полей. 
    // Twig  запустит метод get у этого объекта, а еще метод __isset.
    public function __isset($name) {
        //TODO return isset $this->$name;
        return true;
    }
}