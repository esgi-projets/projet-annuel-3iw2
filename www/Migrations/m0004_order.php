<?php

namespace App\Migration;

use App\Core\Migration;

class m0004_order extends Migration
{
  public function up()
  {
    $this->createTable("order", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "payment_id" => "varchar(255) NOT NULL",
      "amount" => "float(10,2) NOT NULL",
      "currency" => "varchar(255) NOT NULL",
      "payment_status" => "varchar(255) NOT NULL",
      "captured_at" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
    ]);
  }

  public function down()
  {
    // Disable foreign key checks
    $this->query("SET FOREIGN_KEY_CHECKS = 0");
    $this->execute("SET FOREIGN_KEY_CHECKS = 0");

    $this->dropTable("order");

    // Enable foreign key checks
    $this->query("SET FOREIGN_KEY_CHECKS = 1");
    $this->execute("SET FOREIGN_KEY_CHECKS = 1");
  }
}
