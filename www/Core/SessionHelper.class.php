<?php

namespace App\Core;

if (!isset($_SESSION)) {
  session_start();
}

class SessionHelper
{
  public function error($name = '', $message = '', $class = 'form-message form-message-red')
  {
    if (!empty($name)) {
      if (!empty($message) && empty($_SESSION[$name])) {
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
      } else if (empty($message) && !empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : $class;
        echo '<div class="' . $class . '" >' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
      }
    }
  }

  public function redirect($location)
  {
    header("location: " . $location);
    exit();
  }
}
