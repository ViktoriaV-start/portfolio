<?php
namespace app\model\repositories;

use app\engine\App;
use app\model\Repository;
use app\model\entities\Order;

class OrderRepo extends Repository
{
    public function getTableName() {
        return 'orders';
    }
    public function getSessionId() {
        return session_id();
    }


    public function setOrderId($order_id, $session_id) {
        $tableName = 'carts';
        $params = [
            ':order_id' => $order_id,
            ':session_id' => $session_id
        ];

        $sql = "UPDATE {$tableName} 
                   SET `order_id` = :order_id
                 WHERE `session_id` = :session_id AND `order_id` IS NULL;";
        App::call()->db->execute($sql, $params);         
    }

    protected function getEntityClass()
    {
        return Order::class;
    }
}
