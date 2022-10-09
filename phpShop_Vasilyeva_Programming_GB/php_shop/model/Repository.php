<?php

namespace app\model;

use app\engine\App;
use app\interfaces\IModel;

abstract class Repository implements IModel
{
    public function getLimit($page) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return App::call()->db->queryLimit($sql, $page);
    }

// getAll -----------------------
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

// getOne -----------------------
    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryOneObj($sql, ['id' => $id], $this->getEntityClass());
    }

// INSERT -----------------------
    public function insert(Model $entity) {
            $params = [];
            $columns = [];
            $values = "";

        foreach ($entity->props as $key => $value) {
            $params[":{$key}"] = $entity->$key;
            $columns[] = "$key";
        }

        $columns = implode(", ", $columns);

        $values = implode(", ", array_keys($params));
        $tableName = $this->getTableName();

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values});";
        App::call()->db->execute($sql, $params);
        
        $entity->id = App::call()->db->lastInsertId();
        return $entity->id;
    }

// DELETE -----------------------

    public function delete(Model $entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id;";

        return App::call()->db->execute($sql, [':id' => $entity->id]);
    }

// UPDATE -----------------------
    public function update(Model $entity) {
        
        $params = [];
        $columns = [];
        
        foreach ($entity->props as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $entity->$key;
            $columns[] .= "`{$key}` = :{$key}";
        }

        $columns = implode(", ", $columns);
        $params['id'] = $entity->id;
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$columns} WHERE `id` = :id";
        App::call()->db->execute($sql, $params);
    }

// НАЙТИ ПО ОПРЕДЕЛЕННОМУ полю = имени столбца в БД -----------------------------------------------------

    public function getWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field}` = :value";

        return App::call()->db->queryOneObj($sql, ['value' => $value], $this->getEntityClass());
    }

    // НАЙТИ ПО ОПРЕДЕЛЕННОМУ полю = имени столбца в БД  еще полю = имени-----------------------------------------------------

    public function getWhereAnd($field1, $field2, $value1, $value2) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field1}` = :value1 AND `{$field2}` = :value2";

        return App::call()->db->queryOneObj($sql, ['value1' => $value1, 'value2' => $value2,], $this->getEntityClass());
    }

// Посчитать сумму по определенному полю в БД -----------------------------------------------------

    public function getCountWhere($counted, $field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT SUM({$counted}) AS count FROM {$tableName} WHERE `{$field}` = :value;";

        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

// НАЙТИ КАТЕГОРИЮ -----------------------------------------------------
    public function getCategory($category_id)
    {
        $tableName = 'categories';
        $sql = "SELECT `name` FROM {$tableName} WHERE `id` = :id";

        return App::call()->db->queryOne($sql, ['id' => $category_id]);
    }

// УСТАНОВИТЬ ТЕКУЩУЮ ДАТУ -----------------------------------------------------
    public function setDate($field, $id)
    {
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET `{$field}` = NOW() WHERE `id` = :id;";

        return App::call()->db->execute($sql, ['id' => $id]);
    }

    abstract protected function getEntityClass();
    abstract protected function getTableName();
}

