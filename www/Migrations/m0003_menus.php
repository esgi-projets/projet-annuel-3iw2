<?php

namespace App\Migration;

use App\Core\Migration;

class m0002_pages extends Migration
{
  public function up()
  {
    $this->createTable("menu", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "title" => "varchar(255) NOT NULL",
      "href" => "varchar(255) NOT NULL",
      "order" => "int(11) NOT NULL",
      "createdAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
      "updatedAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ]);
  }

  public function down()
  {
    $this->dropTable("menu");
  }
}
