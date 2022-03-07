<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User;

class Admin
{
    public function dashboard()
    {
        $user = unserialize($_SESSION["user"]);
        $view = new View("dashboard");
        $view->assign("titleSeo", "Dashboard | CMS");
        $view->assign("user", $user);
    }
}
