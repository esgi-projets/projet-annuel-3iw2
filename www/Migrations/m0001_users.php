<?php

namespace App\Migration;

use App\Core\Migration;

class m0001_users extends Migration
{
  public function up()
  {
    $this->createTable("user", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "firstname" => "varchar(50) NOT NULL",
      "lastname" => "varchar(100) NOT NULL",
      "email" => "varchar(320) NOT NULL",
      "password" => "varchar(255) NOT NULL",
      "status" => "tinyint(1) NOT NULL DEFAULT '0'",
      "role" => "varchar(100) NOT NULL DEFAULT 'user'",
      "token" => "char(32) NULL",
      "createdAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
      "updatedAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ]);
  }

  public function down()
  {
    $this->dropTable("users");
  }
}
