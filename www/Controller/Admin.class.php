<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\Page;
use App\Model\User;

class Admin
{
    public function dashboard()
    {
        $user = Auth::getUser();
        $view = new View("dashboard", "back");
        $view->assign("titleSeo", "Tableau de bord | CMS");
        $view->assign("user", $user);
    }

    public function orders()
    {
        $user = Auth::getUser();
        $view = new View("admin-orders", "back");
        $view->assign("titleSeo", "Commandes | CMS");
        $view->assign("user", $user);
    }

    public function products()
    {
        $user = Auth::getUser();
        $view = new View("admin-products", "back");
        $view->assign("titleSeo", "Produits | CMS");
        $view->assign("user", $user);
    }

    public function shop()
    {
        $user = Auth::getUser();
        $view = new View("admin-shop", "back");
        $view->assign("titleSeo", "Gestion de la boutique | CMS");
        $view->assign("user", $user);
    }

    public function pages()
    {
        $user = Auth::getUser();
        $pages = new Page();
        $view = new View("admin-pages", "back");
        $view->assign("titleSeo", "Gestion des pages | CMS");
        $view->assign("pages", $pages);
        $view->assign("user", $user);
    }

    public function menus()
    {
        $user = Auth::getUser();
        $view = new View("admin-menus", "back");
        $view->assign("titleSeo", "Gestion des menus | CMS");
        $view->assign("user", $user);
    }

    public function reviews()
    {
        $user = Auth::getUser();
        $view = new View("admin-reviews", "back");
        $view->assign("titleSeo", "Gestion des commentaires | CMS");
        $view->assign("user", $user);
    }
}
