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
        print_r($user);
    }

    public function contact()
    {
        $view = new View("contact");
    }

    public function test()
    {
        $view = new View("test");
        $view->assign("titleSeo", "test");
    }
}
