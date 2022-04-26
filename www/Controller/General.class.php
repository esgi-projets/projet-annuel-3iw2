<?php

namespace App\Controller;

use App\Core\Email;

class General
{

    public function home()
    {
        $email = new Email();
        $email->to = 'alexandre.esgi@gmail.com';
        $email->name = 'Alexandre BETTAN';
        $email->subject = 'Test';
        $email->body = 'Ceci est un jolie test';
        $email->debug = true;
        $email->send();
        echo "Ceci est la page d'accueil";
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
