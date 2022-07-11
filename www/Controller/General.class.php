<?php

namespace App\Controller;

use App\Core\Email;
use App\Core\View;

class General
{

    public function home()
    {
        $view = new View("home");
        $view->assign("titleSeo", "Accueil | CMS");
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

    public function test()
    {
        $view = new View("test");
        $view->assign("titleSeo", "Accueil | CMS");
    }
}
