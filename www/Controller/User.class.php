<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Email;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;

class User
{
    public function login()
    {
        if (!Auth::isLogged()) {
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
                    $view = new View("login", "auth");
                    $view->assign("user", $user);
                    $view->assign("error", true);
                    $view->assign("errorMessage", "E-mail ou mot de passe invalide. Vérifiez vos identifiants.");
                    return;
                }
            }

            $view = new View("login", "auth");
            $view->assign("user", $user);
            $view->assign("titleSeo", "Se connecter");
        } else {
            header("Location: /dashboard");
            exit;
        }
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

    public function reset()
    {
        if (!Auth::isLogged()) {
            $user = new UserModel();

            if (!empty($_POST)) {
                if (isset($_POST['email'])) {
                    $findUser = $user->find('email', $_POST['email'], UserModel::class);
                    if ($findUser) {
                        $findUser->generateToken();
                        $findUser->save();

                        $email = new Email();
                        $email->to = $findUser->getEmail();
                        $email->name = $findUser->getFirstname() . " " . $findUser->getLastname();
                        $email->subject = "Réinitialisation de votre mot de passe";
                        $email->body = "Bonjour,<br>
                    <br>
                    Vous avez demandé la réinitialisation de votre mot de passe. Pour le réinitialiser, cliquez sur le lien ci-dessous :<br>
                    <a href='http://localhost/reset/" . $findUser->getToken() . "'>Réinitialiser mon mot de passe</a><br>
                    <br>
                    Si vous n'êtes pas à l'origine de cette demande, ignorez cet e-mail.<br>
                    <br>
                    L'équipe de CMS";
                        $email->send();

                        $view = new View("reset", "auth");
                        $view->assign("user", $user);
                        $view->assign("success", true);
                        $view->assign("successMessage", "Votre demande de réinitialisation de mot de passe a bien été prise en compte. Vous allez recevoir un e-mail contenant un lien de réinitialisation de votre mot de passe.");
                        $view->assign("titleSeo", "Réinitialisation de votre mot de passe");
                        return;
                    } else {
                        $view = new View("reset", "auth");
                        $view->assign("user", $user);
                        $view->assign("success", true);
                        $view->assign("successMessage", "Votre demande de réinitialisation de mot de passe a bien été prise en compte. Vous allez recevoir un e-mail contenant un lien de réinitialisation de votre mot de passe.");
                        return;
                    }
                } else if (isset($_POST['password'])) {
                    $userFind = $user->find('token', $_POST['token'], UserModel::class);
                    if ($userFind) {
                        $result = Validator::run($user->getFormResetPassword(), $_POST);

                        if ($result) {
                            $view = new View("reset", "auth");
                            $view->assign("user", $user);
                            $view->assign("token", $_POST['token']);
                            $view->assign("error", true);
                            $view->assign("errorMessage", "La réinitialisation de votre mot de passe n'a pu aboutir pour les raisons suivantes :");
                            $view->assign("listErrors", $result);
                            $view->assign("titleSeo", "Réinitialisation de votre mot de passe");
                            return;
                        }

                        $userFind->setPassword($_POST['password']);
                        $userFind->generateToken();
                        $userFind->save();

                        $view = new View("reset", "auth");
                        $view->assign("user", $user);
                        $view->assign("success", true);
                        $view->assign("successMessage", "Votre mot de passe a bien été réinitialisé. Vous pouvez maintenant vous connecter.");
                        $view->assign("titleSeo", "Réinitialisation de votre mot de passe");
                        return;
                    }
                }
            } else if (!empty($_GET)) {
                $userFind = $user->find('token', $_GET['token'], UserModel::class);
                if ($userFind) {
                    $view = new View("reset", "auth");
                    $view->assign("user", $user);
                    $view->assign("token", $userFind->getToken());
                    $view->assign("titleSeo", "Réinitialisation de votre mot de passe");
                    return;
                }
            }

            $view = new View("reset", "auth");
            $view->assign("user", $user);
            $view->assign("titleSeo", "Réinitialiser votre mot de passe");
        } else {
            header("Location: /dashboard");
            exit;
        }
    }

    public function activate()
    {
        $user = new UserModel();


        if (!empty($_GET)) {
            $findUser = $user->find('token', $_GET['token'], UserModel::class);

            if ($findUser) {
                if ($findUser->getStatus() !== 1) {
                    $findUser->setStatus(true);
                    $findUser->generateToken();
                    $findUser->save();

                    echo "Votre compte a bien été activé."; //TODO: redirection avec message de succès type checkmark
                    return;
                } else {
                    echo "Votre compte est déjà actif."; //TODO: redirection avec message de succès type checkmark
                    return;
                }
            } else {
                echo "Ce lien d'activation n'est pas valide."; //TODO : page d'erreur
                return;
            }
        }
    }

    public function register()
    {
        if (!Auth::isLogged()) {
            $user = new UserModel();

            if (!empty($_POST)) {
                $result = Validator::run($user->getFormRegister(), $_POST);

                if ($result) {
                    $view = new View("register", "auth");
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

            $view = new View("register", "auth");
            $view->assign("user", $user);
        } else {
            header("Location: /dashboard");
            exit;
        }
    }
}
