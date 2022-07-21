<?php

namespace App\Migration;

use App\Core\Migration;

class m0007_order_content extends Migration
{
  public function up()
  {
    $this->createTable("order_content", [
      "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "product_id" => "int(11)",
      "quantity" => "int(11) NOT NULL DEFAULT 1",
      "order_id" => "int(11)",
      "createdAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
      "updatedAt" => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ], [
      "CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `" . $_ENV['DB_PREFIX'] . "products`(`id`) ON DELETE SET NULL ON UPDATE CASCADE",
      "CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `" . $_ENV['DB_PREFIX'] . "order`(`id`) ON DELETE SET NULL ON UPDATE CASCADE"
    ]);
  }

  public function down()
  {
    // Disable foreign key checks
    $this->setForeignKeyChecks(false);

    $this->dropTable("order_content");

    // Enable foreign key checks
    $this->setForeignKeyChecks(true);
  }
}
