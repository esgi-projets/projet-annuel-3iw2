<?php

namespace App\Controller;

use App\Core\View;

class General
{

    public function home()
    {
        echo "Welcome";
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

    public function terms()
    {
        $view = new View("terms");
        $view->assign("titleSeo", "Conditions d'utilisation");
    }

    public function privacy()
    {
        $view = new View("privacy");
        $view->assign("titleSeo", "Politique de confidentialité");
    }
}
