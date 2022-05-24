<?php

namespace App;

use App\Core\Migration;

require __DIR__ . '/../index.php'; // implement the autoloader

$migrations = new Migration();

echo ("[CMS] \e[1;37;33mApplying migrations...\e[0m\n\n");

if (isset($argv[1]) && $argv[1] === '--down') {
  $migrations->downMigrations();
} else {
  $migrations->applyMigrations();
}

echo ("\n[CMS] \e[1;37;42mMigrations applied\e[0m\n");
