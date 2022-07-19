<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Validator;
use App\Core\View;
use App\Model\Page as PageModel;

class Page
{
  public function create()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $page = new PageModel();
      $user = Auth::getUser();

      if (!empty($_POST)) {
        $result = Validator::run($page->getFormPage(), $_POST);

        if ($result) {
          $view = new View("admin-pages-manage", "back");
          $view->assign("user", $user);
          $view->assign("error", true);
          $view->assign("page", $page);
          $view->assign("title", "Créer une page 📝");
          $view->assign("titleSeo", "Créer une page");
          $view->assign("errorMessage", "La page n'a pu être enregistrée pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }


        $page->setTitle($_POST["title"]);
        $page->setSlug($_POST["slug"]);
        $page->setContent($_POST["content"]);
        $page->save();
        header("Location: /admin/pages");
      }

      $view = new View("admin-pages-manage", "back");
      $view->assign("user", $user);
      $view->assign("page", $page);
      $view->assign("title", "Créer une page 📝");
      $view->assign("titleSeo", "Créer une page");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function edit()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $page = new PageModel();
      $user = Auth::getUser();

      if (!empty($_POST)) {
        $result = Validator::run($page->getFormPage(), $_POST);
        $findPage = $page->find('id', $_POST['id'], PageModel::class);

        if ($result) {
          $view = new View("admin-pages-manage", "back");
          $view->assign("user", $user);
          $view->assign("error", true);
          $view->assign("page", $findPage);
          $view->assign("title", "Créer une page 📝");
          $view->assign("titleSeo", "Créer une page");
          $view->assign("errorMessage", "La page n'a pu être enregistrée pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }

        $findPage->setTitle($_POST["title"]);
        $findPage->setSlug($_POST["slug"]);
        $findPage->setContent($_POST["content"]);
        $findPage->save();
        header("Location: /admin/pages");
        return;
      }

      $page->setId($_GET["id"]);
      $view = new View("admin-pages-manage", "back");
      $view->assign("user", $user);
      $view->assign("page", $page);
      $view->assign("title", "Modifier une page");
      $view->assign("titleSeo", "Modifier une page");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function delete()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $page = new PageModel();
      $page->setId($_GET["id"]);
      $page->deleteRecord();
      header("Location: /admin/pages");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function viewPage($id)
  {
    $page = new PageModel();
    $page->setId($id);
    $view = new View("page");
    $view->assign("page", $page);
    $view->assign("title", $page->getTitle());
    $view->assign("titleSeo", $page->getTitle() . "");
  }
}
