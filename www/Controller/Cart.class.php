<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\Products as ProductModel;

class Cart
{
  public function addProductToCart()
  {
    $id = $_GET['id'];
    $quantity = $_GET['quantity'];

    $cart = [];
    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
    }
    $cart[$id] = $quantity;
    $_SESSION['cart'] = $cart;
    $totalQuantity = $this->getTotalQuantity();
    echo json_encode($totalQuantity);
  }

  public function removeProductFromCart()
  {
    $redirect = $_GET['redirect'];
    $id = $_GET['id'];
    $cart = [];
    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
    }
    unset($cart[$id]);
    $_SESSION['cart'] = $cart;
    if ($redirect == 'true') {
      header('Location: /cart');
    } else {
      echo json_encode($cart);
    }
  }

  public function getTotalQuantity()
  {
    $cart = $_SESSION['cart'];
    $totalQuantity = 0;
    foreach ($cart as $quantity) {
      $totalQuantity += $quantity;
    }
    return $totalQuantity;
  }

  public function getTotalQuantityView()
  {
    if (isset($_SESSION['cart'])) {
      $totalQuantity = $this->getTotalQuantity();
      echo json_encode($totalQuantity);
    } else {
      return 0;
    }
  }

  public function getCart()
  {
    if (isset($_SESSION['cart'])) {
      return $_SESSION['cart'];
    }
    return [];
  }

  public function clearCart()
  {
    unset($_SESSION['cart']);
  }

  public function getCartView()
  {
    $user = Auth::getUser();
    $products = new ProductModel();
    $cart = $this->getCart();
    $view = new View('cart');
    $view->assign('titleSeo', "Panier");
    $view->assign('user', $user);
    $view->assign('products', $products);
    $view->assign('cart', $cart);
  }
}
