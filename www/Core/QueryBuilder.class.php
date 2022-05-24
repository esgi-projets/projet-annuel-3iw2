<?php

namespace App\Core;

interface QueryBuilder
{
  public function select(string $table, array $columns): QueryBuilder;
  public function insert(string $table, array $columns): QueryBuilder;
  public function update(string $table, array $columns): QueryBuilder;
  public function delete(string $table): QueryBuilder;
  public function where(string $column, string $operator): QueryBuilder;
  public function getQuery(): string;
}
