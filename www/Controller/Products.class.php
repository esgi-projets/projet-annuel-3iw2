<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Validator;
use App\Core\View;
use App\Model\Products as ProductModel;

class Products
{

  public function dashboard()
  {
    if (Auth::getUser()->getRole() === "admin") {
      $user = Auth::getUser();
      $products = new ProductModel();
      $view = new View("admin-products", "back");
      $view->assign("titleSeo", "Produits");
      $view->assign("products", $products);
      $view->assign("user", $user);
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function list()
  {
    $products = new ProductModel();
    $user = Auth::getUser();
    $view = new View("products-list", "front");
    $view->assign("titleSeo", "Liste des produits");
    $view->assign("products", $products);
    $view->assign("user", $user);
  }

  public function detail()
  {
    $product = new ProductModel();
    $user = Auth::getUser();
    $view = new View("products-detail", "front");
    $view->assign("titleSeo", "Détails du produit");
    $view->assign("product", $product);
    $view->assign("user", $user);
  }

  public function create()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $product = new ProductModel();
      $user = Auth::getUser();

      if (!empty($_POST)) {
        $_POST['image'] = 'empty';

        $result = Validator::run($product->getFormProduct(), $_POST);

        if ($_FILES['image']['error'] !== 4) {
          $uploaddir = './View/assets/images/products/';
          $uploadname = 'product' . date('YmdHis') . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
          $uploadfile = $uploaddir . $uploadname;

          if ($_FILES['image']['size'] < 2000 * 1024) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
              $product->setImage($uploadname);
            } else {
              $result[] = "L'upload de l'image a échoué";
            }
          } else {
            $result[] = "L'image est trop volumineuse (2Mo maximum)";
          }
        }

        if ($result) {
          $view = new View("admin-products-manage", "back");
          $view->assign("user", $user);
          $view->assign("error", true);
          $view->assign("product", $product);
          $view->assign("title", "Créer un produit 🪄");
          $view->assign("titleSeo", "Créer un produit");
          $view->assign("errorMessage", "Le produit n'a pu être enregistré pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }

        $product->setName($_POST["name"]);
        $product->setDescription($_POST["description"]);
        $product->setStock($_POST["stock"]);
        $product->setPrice($_POST["price"]);

        $product->save();
        header("Location: /admin/products");
      }

      $view = new View("admin-products-manage", "back");
      $view->assign("user", $user);
      $view->assign("product", $product);
      $view->assign("title", "Créer un produit 🪄");
      $view->assign("titleSeo", "Créer un produit");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function edit()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $product = new ProductModel();
      $user = Auth::getUser();

      if (!empty($_POST)) {
        $_POST['image'] = 'empty';

        $findProduct = $product->find('id', $_POST['id'], ProductModel::class);
        $result = Validator::run($product->getFormProduct(), $_POST);

        if ($_FILES['image']['error'] !== 4) {
          $uploaddir = './View/assets/images/products/';
          $uploadname = 'product' . date('YmdHis') . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
          $uploadfile = $uploaddir . $uploadname;

          if ($_FILES['image']['size'] < 2000 * 1024) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
              $findProduct->setImage($uploadname);
            } else {
              $result[] = "L'upload de l'image a échoué";
            }
          } else {
            $result[] = "L'image est trop volumineuse (2Mo maximum)";
          }
        }

        if ($result) {
          $view = new View("admin-products-manage", "back");
          $view->assign("user", $user);
          $view->assign("error", true);
          $view->assign("product", $findProduct);
          $view->assign("title", "Modifier un produit 📝");
          $view->assign("titleSeo", "Modifier une page");
          $view->assign("errorMessage", "Le produit n'a pu être enregistré pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }

        $findProduct->setName($_POST["name"]);
        $findProduct->setDescription($_POST["description"]);
        $findProduct->setStock($_POST["stock"]);
        $findProduct->setPrice($_POST["price"]);
        $findProduct->save();
        header("Location: /admin/products");
        return;
      }

      $product->setId($_GET["id"]);
      $view = new View("admin-products-manage", "back");
      $view->assign("user", $user);
      $view->assign("product", $product);
      $view->assign("title", "Modifier un produit 🪄");
      $view->assign("titleSeo", "Modifier un produit");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function delete()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $product = new ProductModel();
      $product->setId($_GET["id"]);
      $product->deleteRecord();
      header("Location: /admin/products");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }
}
