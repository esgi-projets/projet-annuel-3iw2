<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;

class Errors
{
  public function error404()
  {
    header('HTTP/1.0 404 Not Found');
    $view = new View("404", "error");
    $view->assign("titleSeo", "404 - Page introuvable");
  }

  public function error500()
  {
    header('HTTP/1.0 500 Internal Server Error');
    $view = new View("500", "error");
    $view->assign("titleSeo", "500 - Erreur serveur");
  }
}
