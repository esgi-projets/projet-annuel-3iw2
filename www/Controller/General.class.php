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
}
