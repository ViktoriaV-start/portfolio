<?php

namespace app\model\entities;

use app\model\Model;

class Order extends Model
{
    public $id;
    public $session_id;
    public $user_id;
    public $created_at;
    public $updated_at;
    public $finished_at;

    protected $props = [
        'session_id' => false, // это означает, что поле не изменилось
        'user_id' => false,
        'created_at' => false,
        'updated_at' => false,
        'finished_at' => false
    ];

    public function __construct($session_id = null,  $user_id = null, $created_at = null, $updated_at = null, $finished_at = null)
    {
        $this->session_id = $session_id;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->finished_at = $finished_at;
    }
}
