<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Email;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;
use App\Model\Settings as SettingsModel;

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
                    if ($findUser->getStatus()) {
                        $user->setId($findUser->getId());
                        $_SESSION["user"] = serialize($user);
                        header("Location: /dashboard");
                    } else {
                        $view = new View("login", "auth");
                        $view->assign("user", $user);
                        $view->assign("error", true);
                        $view->assign("errorMessage", "Votre adresse e-mail n'a pas été confirmée. Veuillez vérifier votre boîte de réception.");
                        exit;
                    }
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

    public function profile()
    {
        if (Auth::isLogged()) {
            $user = Auth::getUser();
            $model = new UserModel();
            $find = $model->find('id', Auth::getUser()->getId(), UserModel::class);


            if (!empty($_POST)) {
                $_POST['id'] = $find->getId();
                $result = Validator::run($model->getFormProfile(), $_POST);

                if ($_FILES['avatar']['error'] !== 4) {
                    $uploaddir = './View/assets/images/profiles/';
                    $uploadname = 'avatar' . date('YmdHis') . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                    $uploadfile = $uploaddir . $uploadname;

                    if ($_FILES['avatar']['size'] < 2000 * 1024 && in_array(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
                        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
                            if ($find) {
                                $find->setAvatar($uploadname);
                                $find->save();
                            } else {
                                $model->setAvatar($uploadname);
                                $model->save();
                            }
                        } else {
                            $result[] = "L'upload de l'image a échoué";
                        }
                    } else {
                        $result[] = "L'image est trop volumineuse (2Mo maximum) ou le format n'est pas autorisé";
                    }
                }


                if ($result) {
                    $view = new View("profile", "back");
                    $view->assign("user", $user);
                    $view->assign("titleSeo", "Mon profil");
                    $view->assign("error", true);
                    $view->assign("errorMessage", "Les préférences n'ont pu être enregistrés pour les raisons suivantes :");
                    $view->assign("listErrors", $result);
                    return;
                }

                $find->setFirstname($_POST['firstname']);
                $find->setLastname($_POST['lastname']);
                if ($_POST['email'] !== $user->getEmail()) {
                    $find->setEmail($_POST['email']);
                    $find->setStatus(false);
                    $find->generateToken();
                    $find->save();
                    $email = new Email();
                    $email->to = $user->getEmail();
                    $email->name = $user->getFirstname() . " " . $user->getLastname();
                    $email->subject = 'Changement d\'adresse e-mail';
                    $email->body = '<p>Bonjour ' . $user->getFirstname() . ',</p>
                                <p>Vous avez demandé un changement d\'adresse e-mail pour votre compte.</p>
                                <p>Pour activer votre compte, veuillez cliquer <a href="http://' . $_SERVER['HTTP_HOST'] . '/activate/' . $find->getToken() . '">ici</a>.</p>
                                <p>Vous pouvez dès à présent vous connecter sur le site en utilisant votre adresse e-mail et votre mot de passe.</p>
                                <p>À bientôt !</p>';

                    $email->send();
                }

                if (
                    $_POST['password'] !== "" && $_POST['password_new'] != ""
                ) {
                    if (password_verify($_POST['password'], $find->getPassword())) {
                        $find->setPassword($_POST['password_new']);
                        $find->generateToken();

                        $email = new Email();
                        $email->to = $find->getEmail();
                        $email->name = $find->getFirstname() . " " . $find->getLastname();
                        $email->subject = "Modification de votre mot de passe";
                        $email->body = "Bonjour,<br>
                <br>
                Vous venez de modifier votre mot de passe sur notre plateforme. Votre sécurité est très importante pour nous.
                <br>
                Ce mail est simplement une confirmation de cette modification.<br>
                Si vous n'êtes pas à l'origine de cette modification, veuillez nous contacter immédiatement.<br>
                <br>
                Cordialement.";
                        $email->send();
                    } else {
                        $view = new View("profile", "back");
                        $view->assign("user", $user);
                        $view->assign("titleSeo", "Mon profil");
                        $view->assign("error", true);
                        $view->assign("errorMessage", "Les préférences n'ont pu être enregistrés pour les raisons suivantes :");
                        $view->assign("listErrors", ["Le mot de passe actuel est incorrect"]);
                        return;
                    }
                }

                $find->save();

                $view = new View("profile", "back");
                $view->assign("user", $find);
                $view->assign("titleSeo", "Mon profil");
                $view->assign("success", true);
                $view->assign("successMessage", "Vos préférences ont bien été enregistrés. Connectez-vous à nouveau pour prendre en compte les changements.");
                return;
            }

            $view = new View("profile", "back");
            $view->assign("user", $find);
            $view->assign("titleSeo", "Mon profil");
        } else {
            header("Location: /login");
            exit;
        }
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
                    <a href='http://" . $_SERVER['HTTP_HOST'] . "/reset/" . $findUser->getToken() . "'>Réinitialiser mon mot de passe</a><br>
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

                    $view = new View("email-validation", "auth");
                    $view->assign("user", $user);
                    return;
                } else {
                    $view = new View("email-validation", "auth");
                    $view->assign("user", $user);
                    return;
                }
            } else {
                $error = new Errors();
                $error->error404();
                exit;
            }
        }
    }

    public function register()
    {
        if (!Auth::isLogged()) {
            $user = new UserModel();
            $settings = new SettingsModel();

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

                if ($settings->getSetting('email_grant') === $dataSanitized['email']) {
                    $user->setRole("admin");
                    $settings->setSetting('email_grant', NULL);
                    $settings->save();
                }

                $user->save();

                $email = new Email();
                $email->to = $user->getEmail();
                $email->name = $user->getFirstname() . " " . $user->getLastname();
                $email->subject = 'Vous y êtes presque 👀';
                $email->body = '<p>Bonjour ' . $user->getFirstname() . ',</p>
                            <p>Vous venez de vous inscrire sur notre site.</p>
                            <p>Pour activer votre compte, veuillez cliquer <a href="http://' . $_SERVER['HTTP_HOST'] . '/activate/' . $user->getToken() . '">ici</a></p>
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
