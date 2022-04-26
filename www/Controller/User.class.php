<?php

namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Email;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;

class User
{
    public function login()
    {
        $user = new UserModel();

        if (!empty($_POST)) {
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

    public function activate()
    {
        $user = new UserModel();
        echo $_SERVER['QUERY_STRING'];

        if (!empty($_GET)) {
            $userFind = $user->find('token', $_GET['token']);

            if (isset($userFind->id) && $userFind !== null) {
                $user->setId($userFind->id);
                $user->setStatus(1);
                $user->generateToken();
                $user->save();

                echo "Votre compte a bien été activé.";
                // $view = new View("activation");
                // $view->assign("user", $user);
                // $view->assign("titleSeo", "Activation | CMS");
                return;
            }
        }
    }

    public function register()
    {

        $user = new UserModel();

        if (!empty($_POST)) {
            $result = Validator::run($user->getFormRegister(), $_POST);

            if ($result) {
                $view = new View("register");
                $view->assign("user", $user);
                $view->assign("error", true);
                $view->assign("errorMessage", "Votre inscription n'a pu aboutir pour les raisons suivantes :");
                $view->assign("listErrors", $result);
                return;
            }

            $dataSanitized = Validator::sanitizeArray($_POST);
            $user->setFirstname($dataSanitized['firstname']);
            $user->setLastname($dataSanitized['lastname']);
            $user->setEmail($dataSanitized['email']);
            $user->setPassword($dataSanitized['password']);
            $user->generateToken();

            $user->save();

            $email = new Email();
            $email->to = $user->getEmail();
            $email->name = $user->getFirstname() . " " . $user->getLastname();
            $email->subject = 'Vous y êtes presque 👀';
            $email->body = '<p>Bonjour ' . $user->getFirstname() . ',</p>
                            <p>Vous venez de vous inscrire sur notre site.</p>
                            <p>Pour activer votre compte, veuillez cliquer <a href="http://localhost/activate/' . $user->getToken() . '">ici</a></p>
                            <p>Vous pouvez dès à présent vous connecter sur le site en utilisant votre adresse e-mail et votre mot de passe.</p>
                            <p>À bientôt !</p>';

            $email->send();
        }

        $view = new View("register");
        $view->assign("user", $user);
    }
}
