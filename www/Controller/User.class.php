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

        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $isValid = $this->checkLoginPassword();
            if ($isValid) {
                $findUser = $user->find('email', $_POST["email"], UserModel::class);
                $user->setId($findUser->getId());

                $_SESSION["user"] = serialize($user);
                header("Location: /dashboard");
                exit;
            } else {
                $view = new View("login");
                $view->assign("user", $user);
                $view->assign("error", true);
                $view->assign("errorMessage", "E-mail ou mot de passe invalide. Vérifiez vos identifiants.");
                return;
            }
        }

        $view = new View("login");
        $view->assign("user", $user);
        $view->assign("titleSeo", "Se connecter | CMS");
    }

    public function checkLoginPassword()
    {
        $user = new UserModel();

        if (Validator::checkEmail($_POST['email'])) {
            $userFind = $user->find('email', $_POST['email']);

            if (isset($userFind->id) && $userFind !== null) {
                if (password_verify($_POST['password'], $userFind->password)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit;
    }

    public function register()
    {

        /*$user = new UserModel();

        //print_r($_POST);
        if (!empty($_POST)) {
            $result = Validator::run($user->getFormRegister(), $_POST);
            print_r($result);
        }

        //$user= $user->setId(3);
        //$user->setEmail("toto@gmail.com");
        //$user->save();*/

        $view = new View("register");
        //$view->assign("user", $user);
        $view->assign("titleSeo", "S'inscrire | CMS");
    }

    public function forgot_password()
    {
        $view = new View("forgot_password");
        $view->assign("titleSeo", "Réinitialiser son mot de passe | CMS");
    }
}
