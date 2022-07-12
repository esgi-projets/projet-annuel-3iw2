<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\Page as PageModel;

class Page
{
  public function create()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      if (!empty($_POST)) {
        $page = new PageModel();
        $page->setTitle($_POST["title"]);
        $page->setSlug($_POST["slug"]);
        $page->setContent($_POST["content"]);
        $page->save();
        header("Location: /admin/pages");
      }

      $user = Auth::getUser();
      $page = new PageModel();
      $view = new View("admin-pages-manage", "back");
      $view->assign("user", $user);
      $view->assign("page", $page);
      $view->assign("title", "Créer une page 📝");
      $view->assign("titleSeo", "Créer une page | CMS");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function edit()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      if (!empty($_POST)) {
        $page = new PageModel();
        $page->setId($_POST["id"]);
        $page->setTitle($_POST["title"]);
        $page->setSlug($_POST["slug"]);
        $page->setContent($_POST["content"]);
        $page->save();
        header("Location: /admin/pages");
      }

      $user = Auth::getUser();
      $page = new PageModel();
      $page->setId($_GET["id"]);
      $view = new View("admin-pages-manage", "back");
      $view->assign("user", $user);
      $view->assign("page", $page);
      $view->assign("title", "Modifier une page");
      $view->assign("titleSeo", "Modifier une page | CMS");
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
    $view->assign("titleSeo", $page->getTitle() . " | CMS");
  }
}
