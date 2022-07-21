<?php

namespace App\Migration;

use App\Core\Migration;

class m0003_menus extends Migration
{
  public function up()
  {
    $this->createTable("menu", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "title" => "varchar(255) NOT NULL",
      "href" => "varchar(255) NULL",
      "position" => "int(11) NOT NULL",
      "page_id" => "int(11)",
      "createdAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
      "updatedAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ], ["CONSTRAINT `fk_menu_page` FOREIGN KEY (`page_id`) REFERENCES `" . $_ENV['DB_PREFIX'] . "page`(`id`) ON DELETE SET NULL ON UPDATE CASCADE"]);
  }

  public function down()
  {
    // Disable foreign key checks
    $this->setForeignKeyChecks(false);

    $this->dropTable("menu");

    // Enable foreign key checks
    $this->setForeignKeyChecks(true);
  }
}
