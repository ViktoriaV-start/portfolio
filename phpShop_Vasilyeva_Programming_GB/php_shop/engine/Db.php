<?php

namespace app\engine;

class Db
{
    private $config;

    protected $connection = null;  // объект PDO будем хранить непосредственно в поле класса Db.

    public function __construct($driver, $host, $login, $password, $database, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    protected function getConnection() {
        if (is_null($this->connection)) {

            $this->connection = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']);

           $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    protected function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public  function lastInsertId() {
        return $this->connection->lastInsertId();
    }

    protected function query($sql, $params) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
}

    public function queryLimit($sql, $page) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(1, $page, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function queryOne($sql, $params){
        return $this->query($sql, $params)->fetch();
    }

    public function queryOneObj($sql, $params, $class){
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);

        return $stmt->fetch();
    }

    public function queryAll($sql, $params = []){
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = []){
        return $this->query($sql, $params)->rowCount();
    }
}