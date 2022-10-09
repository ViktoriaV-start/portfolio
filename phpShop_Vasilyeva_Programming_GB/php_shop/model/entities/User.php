<?php

namespace app\model\entities;

use app\model\Model;

class User extends Model
{
    protected $id;
    protected $login;
    protected $name;
    protected $surname;
    protected $email;
    protected $phone;
    protected $pass;
    protected $hash;
    protected $address;

    protected $props = [
        'login' => false,
        'name' => false,
        'surname' => false,
        'email' => false,
        'phone' => false,
        'address' => false,
        'pass' => false,
        'hash' => false
    ];

    public function __construct($login = null, $name = null, $surname = null, $email = null, $phone = null, $address = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->pass = $pass;
        $this->hash = $hash;
    }
}