<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\User;

class Admin
{
    public function dashboard()
    {
        $user = Auth::getUser();
        $view = new View("dashboard");
        $view->assign("titleSeo", "Dashboard | CMS");
        $view->assign("user", $user);
    }

    public function orders()
    {
        $user = Auth::getUser();
        $view = new View("admin-orders");
        $view->assign("titleSeo", "Commandes | CMS");
        $view->assign("user", $user);
    }

    public function products()
    {
        $user = Auth::getUser();
        $view = new View("admin-products");
        $view->assign("titleSeo", "Produits | CMS");
        $view->assign("user", $user);
    }

    public function users()
    {
        $user = Auth::getUser();
        $view = new View("admin-users");
        $view->assign("titleSeo", "Utilisateurs | CMS");
        $view->assign("user", $user);
    }

    public function shop()
    {
        $user = Auth::getUser();
        $view = new View("admin-shop");
        $view->assign("titleSeo", "Gestion de la boutique | CMS");
        $view->assign("user", $user);
    }

    public function pages()
    {
        $user = Auth::getUser();
        $view = new View("admin-pages");
        $view->assign("titleSeo", "Gestion des pages | CMS");
        $view->assign("user", $user);
    }

    public function menus()
    {
        $user = Auth::getUser();
        $view = new View("admin-menus");
        $view->assign("titleSeo", "Gestion des menus | CMS");
        $view->assign("user", $user);
    }
}
