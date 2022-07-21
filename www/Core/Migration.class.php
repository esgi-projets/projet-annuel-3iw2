<?php

namespace App\Core;

class Migration extends BaseSQL
{
  protected function createTable(string $table, array $columns, array $options = [])
  {
    $table = $_ENV['DB_PREFIX'] . $table;
    $query = "CREATE TABLE if not exists $table (" . implode(", ", array_map(function ($column, $value) {
      return "$column $value";
    }, array_keys($columns), array_values($columns)));
    if (count($options) > 0) {
      $query .= ", " . implode(", ", $options);
    }
    $query .= ")";
    $this->query($query);
    $this->execute($query);
  }

  protected function dropTable(string $table)
  {
    $table = $_ENV['DB_PREFIX'] . $table;
    $query = $this->query("DROP TABLE $table");
    $this->execute($query);
  }

  protected function createMigrationsTable()
  {
    $this->createTable('migrations', [
      'id' => 'INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
      'name' => 'VARCHAR(255) NOT NULL',
      'created_at' => 'DATETIME NOT NULL'
    ]);
  }

  public function addMigration(string $name)
  {
    $this->createMigrationsTable();
    $query = $this->query("INSERT INTO " . $_ENV['DB_PREFIX'] . "migrations (name, created_at) VALUES ('$name', NOW())");
    $this->execute($query);
  }

  public function removeMigration(string $name)
  {
    $this->createMigrationsTable();
    $query = $this->query("DELETE FROM " . $_ENV['DB_PREFIX'] . "migrations WHERE name = '$name'");
    $this->execute($query);
  }

  public function applyMigrations($logs = true)
  {
    $migrations = glob(__DIR__ . '/../Migrations/*.php');
    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigrations();
    foreach ($migrations as $migration) {
      $migrationName = basename($migration, '.php');
      if (!in_array($migrationName, $appliedMigrations) && $migrationName != 'migrations') {
        require_once $migration;
        $migrationClass = 'App\Migration\\' . $migrationName;
        $migration = new $migrationClass();
        $migration->up();
        self::addMigration($migrationName);
        if ($logs) {
          echo ("[CMS] \e[0;35;35mApplied migration: \e[0m" . $migrationName . "\n");
        }
      }
    }
  }

  public function downMigrations($logs = true)
  {
    $migrations = glob(__DIR__ . '/../Migrations/*.php');
    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigrations();
    foreach ($migrations as $migration) {
      $migrationName = basename($migration, '.php');
      if (in_array($migrationName, $appliedMigrations) && $migrationName != 'migrations') {
        require_once $migration;
        $migrationClass = 'App\Migration\\' . $migrationName;
        $migration = new $migrationClass();
        $migration->down();
        self::removeMigration($migrationName);
        if ($logs) {
          echo ("[CMS] \e[0;35;35mRemoved migration: \e[0m" . $migrationName . "\n");
        }
      }
    }
  }

  public function getAppliedMigrations()
  {
    $query = $this->select($_ENV['DB_PREFIX'] . 'migrations', ['name']);
    $migrations = $this->query($query->getQuery());

    $migrations = $this->resultSet();

    $appliedMigrations = [];
    foreach ($migrations as $migration) {
      $appliedMigrations[] = $migration->name;
    }
    return $appliedMigrations;
  }

  public function setForeignKeyChecks(bool $value)
  {
    $query = $this->query("SET FOREIGN_KEY_CHECKS = " . ($value ? 1 : 0) . ";");
    $this->execute($query);
  }
}
