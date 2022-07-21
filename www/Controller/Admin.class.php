<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\Page;
use App\Model\User;
use App\Model\Order as OrderModel;

class Admin
{
    public function dashboard()
    {
        $user = Auth::getUser();
        $orders = new OrderModel();
        $view = new View("dashboard", "back");
        $view->assign("titleSeo", "Tableau de bord | CMS");
        $view->assign("orders", $orders);
        $view->assign("user", $user);
    }

    public function shop()
    {
        $user = Auth::getUser();
        $view = new View("admin-shop", "back");
        $view->assign("titleSeo", "Gestion de la boutique | CMS");
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
