<?php

namespace app\model\entities;

use app\model\Model;

class Cart extends Model
{
    protected $id;
    protected $session_id;
    protected $order_id;
    protected $product_id;
    protected $quantity;
    protected $price;
    protected $subtotal;

    protected $props = [
        'session_id' => false,
        'order_id' => false,
        'product_id' => false,
        'quantity' => false,
        'price' => false,
        'subtotal' => false
    ];

    public function __construct($session_id = null,  $product_id = null, $quantity = 1, $order_id = null, $subtotal = null)
    {
        $this->session_id = $session_id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->subtotal = $subtotal;
    }
}