<?php

namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;

class User
{

    public function login()
    {
        $user = new UserModel();
        $view = new View("login");
        $view->assign("user", $user);
        $view->assign("error", false);
        $view->assign("errorMessage", "E-mail ou mot de passe invalide. Vérifiez vos identifiants.");
        $view->assign("titleSeo", "Se connecter | CMS");
    }

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {

        $user = new UserModel();

        print_r($_POST);
        if (!empty($_POST)) {
            $result = Validator::run($user->getFormRegister(), $_POST);
            print_r($result);
        }

        //$user= $user->setId(3);
        //$user->setEmail("toto@gmail.com");
        //$user->save();

        $view = new View("register");
        $view->assign("user", $user);
    }
}
