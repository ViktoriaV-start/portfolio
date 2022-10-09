<?php

namespace app\model\entities;
use app\model\Model;

class Product extends Model {
    protected $id;
    protected $name;
    protected $category_id;
    protected $price;
    protected $description;

    protected $props = [
        'name' => false,
        'category_id' => false,
        'price' => false,
        'description' => false
    ];

    public function __construct($name = null, $category_id = null, $price = null, $description = null)
    {
        $this->name = $name;
        $this->category_id = $category_id;
        $this->price = $price;
        $this->description = $description;
    }
}
