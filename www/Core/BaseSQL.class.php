<?php

namespace App\Core;


abstract class BaseSQL extends MySQLBuilder implements QueryBuilder
{
    private $pdo;
    private $stmt;
    protected $table;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO(DBDRIVER . ":host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME, DBUSER, DBPWD);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Erreur SQL" . $e->getMessage());
        }

        $classExploded = explode("\\", get_called_class());
        $this->table = DBPREFIXE . strtolower(end($classExploded));
    }

    protected function save()
    {
        $columns  = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
        $columns = array_filter($columns);


        if (!is_null($this->getId())) {
            foreach ($columns as $key => $value) {
                $setUpdate[] = $key . "=:" . $key;
            }
            $sql = "UPDATE " . $this->table . " SET " . implode(",", $setUpdate) . " WHERE id=" . $this->getId();
        } else {
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ")
            VALUES (:" . implode(",:", array_keys($columns)) . ")";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($columns);
    }

    protected function populate()
    {
        $columns = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
        $columns = array_filter($columns);

        $mysql = new MySQLBuilder();

        $query = $mysql->select($this->table, ['*'])
            ->where("id", "=", $this->getId());

        $this->query($query->getQuery());

        $this->execute();
        $result = $this->stmt->fetch(\PDO::FETCH_ASSOC);

        $this->set_object_vars($this, $result);
    }

    private function set_object_vars($object, array $vars)
    {
        $has = get_object_vars($object);
        foreach ($has as $name => $oldValue) {
            $object->$name = isset($vars[$name]) ? $vars[$name] : NULL;
        }
    }

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    // Bind values, to prepared statement using named parameters
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute query
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Multiple records
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // Single record
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    // Get row count
    protected function rowCount()
    {
        return $this->stmt->rowCount();
    }

    // Find by column value
    public function find($column, $value)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $column . "=:value";
        $this->query($sql);
        $this->bind(":value", $value);
        return $this->single();
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
