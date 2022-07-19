<?php

namespace App\Migration;

use App\Core\Migration;

class m0004_settings extends Migration
{
  public function up()
  {
    $this->createTable("settings", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "name" => "varchar(255) NOT NULL",
      "value" => "varchar(255) NULL",
      "createdAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
      "updatedAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ]);
  }

  public function down()
  {
    // Disable foreign key checks
    $this->setForeignKeyChecks(false);

    $this->dropTable("settings");

    // Enable foreign key checks
    $this->setForeignKeyChecks(true);
  }
}
