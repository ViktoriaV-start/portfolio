<?php

namespace app\model\repositories;

use app\engine\App;
use app\model\Repository;
use app\model\entities\Product;

class ProductRepo extends Repository
{
    public function getTableName() {
        return 'products';
    }
    protected function getEntityClass() {
        return Product::class;
    }

    public function getFilter($search) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `name` REGEXP :search";
        return App::call()->db->queryAll($sql, ['search' => $search], $this->getEntityClass());
    }
}
