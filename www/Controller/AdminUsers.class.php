<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\Page;
use App\Core\Validator;
use App\Model\User as UserModel;

class AdminUsers
{

  public function dashboard()
  {
    if (Auth::getUser()->getRole() === "admin") {
      $user = Auth::getUser();
      $view = new View("admin-users", "back");
      $view->assign("titleSeo", "Utilisateurs | CMS");
      $view->assign("user", $user);
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function edit()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $userEdit = new UserModel();
      $user = Auth::getUser();

      if (!empty($_POST)) {
        $result = Validator::run($userEdit->getFormPage(), $_POST);
        $findUser = $userEdit->find('id', $_POST['id'], UserModel::class);

        if ($result) {
          $view = new View("admin-users-manage", "back");
          $view->assign("user", $findUser);
          $view->assign("error", true);
          $view->assign("title", "Modifier un utilisateur 📝");
          $view->assign("titleSeo", "Modifier un utilisateur");
          $view->assign("errorMessage", "L'utilisateur n'a pu être enregistré pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }

        $findUser->setEmail($_POST["email"]);
        $findUser->setPassword($_POST["password"]);
        $findUser->setFirstname($_POST["firstname"]);
        $findUser->setLastname($_POST["lastname"]);
        $findUser->setStatus($_POST["status"]);
        $findUser->setRole($_POST["role"]);
        $findUser->save();
        header("Location: /admin/users");
        return;
      }

      $userEdit->setId($_GET["id"]);
      $view = new View("admin-users-manage", "back");
      $view->assign("user", $user);
      $view->assign("id", $userEdit);
      $view->assign("title", "Modifier une page");
      $view->assign("titleSeo", "Modifier une page | CMS");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }
}
