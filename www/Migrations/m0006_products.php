<?php

namespace App\Migration;

use App\Core\Migration;

class m0006_products extends Migration
{
  public function up()
  {
    $this->createTable("products", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "name" => "varchar(255) NOT NULL",
      "description" => "LONGTEXT NULL",
      "image" => "varchar(255) NULL",
      "stock" => "int(11) NOT NULL DEFAULT 0",
      "price" => "float(11) NOT NULL DEFAULT 0",
      "createdAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
      "updatedAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ]);
  }

  public function down()
  {
    // Disable foreign key checks
    $this->setForeignKeyChecks(false);

    $this->dropTable("products");

    // Enable foreign key checks
    $this->setForeignKeyChecks(true);
  }
}
