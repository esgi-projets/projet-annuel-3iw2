<?php

namespace App\Controller;

use App\Core\Email;

class General
{

    public function home()
    {
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
