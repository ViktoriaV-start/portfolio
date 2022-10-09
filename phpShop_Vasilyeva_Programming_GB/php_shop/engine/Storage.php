<?php

namespace app\engine;

class Storage
{
    protected $item = [];

    public function get($key)
    {
        if (!isset($this->item[$key])) {
            $this->item[$key] = App::call()->createComponent($key);
        }

        return $this->item[$key];
    }
}