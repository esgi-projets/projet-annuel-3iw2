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
    $this->query = "INSERT INTO $table (" . implode(", ", array_keys($columns)) . ") VALUES (" . implode(", ", array_values($columns)) . ")";
    return $this;
  }

  /**
   * @param string $table
   * @param array $columns
   * @return QueryBuilder
   */
  public function update(string $table, array $columns): QueryBuilder
  {
    $this->query = "UPDATE $table SET " . implode(", ", array_map(function ($column, $value) {
      return "$column = '" . $value . "'";
    }, array_keys($columns), array_values($columns)));
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
   * @param string $value
   * @return QueryBuilder
   */
  public function where(string $column, string $operator, string $value): QueryBuilder
  {
    $this->query .= " WHERE $column $operator $value";
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
   * @return string
   */
  public function getQuery(): string
  {
    return $this->query;
  }
}
