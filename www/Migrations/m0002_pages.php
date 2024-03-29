<?php

namespace App\Migration;

use App\Core\Migration;

class m0002_pages extends Migration
{
  public function up()
  {
    $this->createTable("page", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "title" => "varchar(255) NOT NULL",
      "slug" => "varchar(255) NOT NULL",
      "content" => "longtext NOT NULL",
      "createdAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
      "updatedAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ]);
  }

  public function down()
  {
    // Disable foreign key checks
    $this->setForeignKeyChecks(false);

    $this->dropTable("page");

    // Enable foreign key checks
    $this->setForeignKeyChecks(true);
  }
}
