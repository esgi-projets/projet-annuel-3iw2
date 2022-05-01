<?php

namespace App\Core;

class Auth
{
  public static function isLogged()
  {
    if (isset($_SESSION['user'])) {
      return true;
    }
    return false;
  }

  public static function getUser()
  {
    if (isset($_SESSION['user'])) {
      return unserialize($_SESSION['user']);
    }
    return null;
  }
}
