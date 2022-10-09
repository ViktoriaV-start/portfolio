<?php
namespace app\model\repositories;

use app\engine\App;
use app\model\Repository;
use app\model\entities\Cart; 

class CartRepo extends Repository
{
    public function getTableName() {
        return 'carts';
    }

    public function getPoductsTableName() {
        return App::call()->productRepo->getTableName();
    }

    public function getSessionId() {
        return session_id();
    }

    public function getCart(): array
    {
        $session_id = $this->getSessionId();
        $tableName = $this->getTableName();
        $productsTableName = $this->getPoductsTableName();

        $sql = "SELECT {$tableName}.id,
                       {$tableName}.product_id,
                       {$tableName}.quantity,
                       {$tableName}.price,
                       {$tableName}.subtotal,
                       {$productsTableName}.name
                  FROM {$tableName}
                  JOIN {$productsTableName}
                    ON {$tableName}.product_id = {$productsTableName}.id
                 WHERE session_id = :session_id AND order_id IS NULL;
                       ";

        return App::call()->db->queryAll($sql, ['session_id' => $session_id]);
    }

    public function fixAndCalc($session_id, $productId) {

        App::call()->db->execute("CALL fix_price();"); 
        App::call()->db->execute("CALL calc_subtotal()"); 

        $productCart = $this->getWhereAnd('session_id', 'product_id', $session_id, $productId);
        return $productCart;
    }

    public function deleteAll() {
        $session_id = session_id();
        $tableName = 'carts';
        $sql = "DELETE FROM {$tableName} WHERE session_id = :session_id AND order_id IS NULL;";

        App::call()->db->execute($sql, ['session_id' => $session_id]);
    }

    public function getCountWhere($counted, $field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT SUM({$counted}) AS count FROM {$tableName} WHERE `{$field}` = :value AND order_id IS NULL;";

        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    public function getWhereAnd($field1, $field2, $value1, $value2) {
        $tableName = $this->getTableName();

        $sql = "SELECT * FROM
               (SELECT * FROM {$tableName} 
                 WHERE `{$field1}` = :value1
                   AND `{$field2}` = :value2) AS SHOWCART
                 WHERE order_id IS NULL";

        return App::call()->db->queryOneObj($sql, ['value1' => $value1, 'value2' => $value2,], $this->getEntityClass());
    }

    protected function getEntityClass()
    {
        return Cart::class;
    }
}