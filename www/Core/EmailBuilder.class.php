<?php

namespace App\Core;

interface EmailBuilder
{
  public function send(): EmailBuilder;
}
