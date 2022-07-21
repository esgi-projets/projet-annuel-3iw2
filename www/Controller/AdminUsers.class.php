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
      $users = new UserModel();
      $view = new View("admin-users", "back");
      $view->assign("titleSeo", "Utilisateurs | CMS");
      $view->assign("users", $users);
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
        if (isset($_POST['status']) && $_POST['status'] === "on") {
          $_POST['status'] = 1;
        } else {
          $_POST['status'] = 0;
        }

        $findUser = $userEdit->find('id', $_POST['id'], UserModel::class);
        $result = Validator::run($userEdit->getFormEdit($findUser), $_POST);

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

        if (!empty($_POST["password"] && $_POST["password"] !== "noPassw0rd")) {
          $findUser->setPassword($_POST["password"]);
        }

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
      $view->assign("userEdit", $userEdit);
      $view->assign("title", "Modifier un utilisateur 📝");
      $view->assign("titleSeo", "Modifier un utilisateur");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function delete()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $user = new UserModel();
      $user->setId($_GET["id"]);
      $user->deleteRecord();
      header("Location: /admin/users");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }
}
