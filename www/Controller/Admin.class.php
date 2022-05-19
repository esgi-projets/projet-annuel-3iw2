<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\User;

class Admin
{
    public function dashboard()
    {
        $user = Auth::getUser();
        $view = new View("dashboard");
        $view->assign("titleSeo", "Dashboard | CMS");
        $view->assign("user", $user);
    }
}
