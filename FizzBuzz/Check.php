<?php

abstract class Check implements INum
{

    public $obj = null;
    public $result = null;

    public function __construct(INum $obj) {
        $this->obj = $obj;
    }
}