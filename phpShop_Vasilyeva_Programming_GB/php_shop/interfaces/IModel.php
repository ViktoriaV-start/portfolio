<?php

namespace app\interfaces;

use app\model\Model;

interface IModel
{
    public function getOne($id);
    public function getAll();
    public function getLimit($page);
    public function insert(Model $entity);
    public function delete(Model $entity);
    public function update(Model $entity);
    public function getWhere($field, $value);
    public function getWhereAnd($field1, $field2, $value1, $value2);
    public function getCountWhere($counted, $field, $value);
    public function getCategory($category_id);
    public function setDate($field, $id);


}


