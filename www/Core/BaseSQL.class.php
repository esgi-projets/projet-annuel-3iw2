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
            $this->pdo = new \PDO($_ENV['DB_DRIVER'] . ":host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PWD']);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Erreur SQL" . $e->getMessage());
        }

        $classExploded = explode("\\", get_called_class());
        $this->table = $_ENV['DB_PREFIX'] . strtolower(end($classExploded));
    }

    public function save()
    {

        $columns  = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
        $columns = array_filter($columns);

        $mysql = new MySQLBuilder();

        if (!is_null($this->getId())) {
            $query = $mysql->update($this->table, $columns)->where('id', '=')->getQuery();
        } else {
            $query = $mysql->insert($this->table, $columns)->getQuery();
        }

        $this->query($query);
        $this->bindColumns($columns);
        $this->execute();
    }

    protected function populate()
    {
        $columns = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
        $columns = array_filter($columns);

        $mysql = new MySQLBuilder();

        $query = $mysql->select($this->table, ['*'])
            ->where("id", "=")->getQuery();

        $this->query($query);

        $this->bind(":id", $this->getId());

        $this->execute();
        $result = $this->stmt->fetch(\PDO::FETCH_ASSOC);
        $result = filter_var_array($result, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // XSS protection

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
    protected function query($sql = null)
    {
        if ($sql === null) {
            $sql = $this->getQuery();
        }

        $this->stmt = $this->pdo->prepare($sql);
    }

    // Bind values, to prepared statement using named parameters
    protected function bind($param, $value, $type = null)
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

    // Bind values colums to prepared statement
    protected function bindColumns(array $columns)
    {
        foreach ($columns as $column => $value) {
            $this->bind(":$column", $value);
        }
    }

    // Execute query
    protected function execute()
    {
        return $this->stmt->execute();
    }

    // Multiple records
    protected function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    // Single record
    protected function single($model)
    {
        $this->execute();

        if (!$model) {
            return $this->stmt->fetch(\PDO::FETCH_OBJ);
        } else {
            $this->stmt->setFetchMode(\PDO::FETCH_CLASS, $model);
            return $this->stmt->fetch();
        }
    }

    // Get row count
    protected function rowCount()
    {
        return $this->stmt->rowCount();
    }

    // Find by column value
    public function find($column, $value, $model = null)
    {
        $sql = $this->select($this->table, ['*'])->where($column, '=')->getQuery();
        $this->query($sql);
        $this->bind(':' . $column, $value);
        return $this->single($model);
    }
}
