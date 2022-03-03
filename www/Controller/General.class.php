<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User;

class General
{

    public function home()
    {
        $user = new User();
        $id = $user->find('email', 'test@gmail.com')->id;
        $user->setId($id);

        $view = new View("dashboard");
        $view->assign("firstname", $user->getFirstname());
        $view->assign("lastname", $user->getLastname());
        $view->assign("role", $user->getFormattedRole());
    }
}
