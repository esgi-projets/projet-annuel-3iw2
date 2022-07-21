<?php

namespace App\Core;

class MySQLBuilder implements QueryBuilder
{
  private $query = '';

  /**
   * @param string $table
   * @param array $columns
   * @return QueryBuilder
   */

  public function select(string $table, array $columns): QueryBuilder
  {
    $this->query = "SELECT " . implode(", ", $columns) . " FROM $table";
    return $this;
  }

  /**
   * @param string $table
   * @param array $columns
   * @return QueryBuilder
   */
  public function insert(string $table, array $columns): QueryBuilder
  {
    $this->query = "INSERT INTO " . $table . " (" . implode(", ", array_keys($columns)) . ")
    VALUES (:" . implode(", :", array_keys($columns)) . ")";
    return $this;
  }

  /**
   * @param string $table
   * @param array $columns
   * @return QueryBuilder
   */
  public function update(string $table, array $columns): QueryBuilder
  {
    $this->query = "UPDATE " . $table . " SET ";
    foreach ($columns as $key => $value) {
      $this->query .= $key . " = :" . $key . ", ";
    }
    $this->query = substr($this->query, 0, -2);
    return $this;
  }

  /**
   * @param string $table
   * @return QueryBuilder
   */
  public function delete(string $table): QueryBuilder
  {
    $this->query = "DELETE FROM $table";
    return $this;
  }

  /**
   * @param string $column
   * @param string $operator
   * @return QueryBuilder
   */
  public function where(string $column, string $operator): QueryBuilder
  {
    $this->query .= " WHERE $column $operator :$column";
    return $this;
  }

  /**
   * @param int $limit
   * @return QueryBuilder
   */
  public function limit(int $limit): QueryBuilder
  {
    $this->query .= " LIMIT $limit";
    return $this;
  }

  /**
   * @param string $orderBy
   * @param string $order
   * @return QueryBuilder
   */

  public function orderBy(string $orderBy, string $order): QueryBuilder
  {
    $this->query .= " ORDER BY $orderBy $order";
    return $this;
  }


  /**
   * @return string
   */
  public function getQuery(): string
  {
    return $this->query;
  }
}
