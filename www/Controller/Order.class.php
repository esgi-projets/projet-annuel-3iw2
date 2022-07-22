<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\User;
use App\Model\Order as OrderModel;
use App\Model\Order_Content as OrderContentModel;
use App\Model\Products as ProductModel;
use Omnipay\Omnipay;
use App\Core\Validator;
use App\Controller\Cart;
use App\Model\Settings;
use App\Core\Email;

class Order
{
  public function dashboard()
  {
    $orders = new OrderModel();
    $user = Auth::getUser();
    $view = new View("admin-orders", "back");
    $view->assign("titleSeo", "Commandes");
    $view->assign("orders", $orders);
    $view->assign("user", $user);
  }

  public function detail()
  {
    $orders = new OrderModel();
    $orderContent = new OrderContentModel();
    $product = new ProductModel();
    $user = Auth::getUser();
    $view = new View("order-details", "back");
    $view->assign("titleSeo", "Détails de la commande");
    $view->assign("orders", $orders);
    $view->assign("orderContent", $orderContent);
    $view->assign("product", $product);
    $view->assign("user", $user);
  }

  public function edit()
  {
    if (Auth::isLogged() && Auth::getUser()->getRole() === "admin") {
      $orderEdit = new OrderModel();
      $user = Auth::getUser();

      if (!empty($_POST)) {

        $findOrder = $orderEdit->find('id', $_POST['id'], OrderModel::class);
        $result = Validator::run($orderEdit->getFormOrderEdit($findOrder), $_POST);

        if ($result) {
          $view = new View("admin-orders-manage", "back");
          $view->assign("order", $findOrder);
          $view->assign("user", $user);
          $view->assign("error", true);
          $view->assign("title", "Modifier une commande 📦");
          $view->assign("titleSeo", "Modifier une commande");
          $view->assign("errorMessage", "La commande n'a pas pu être modifiée pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }

        $findOrder->setName($_POST["name"]);
        $findOrder->setLastname($_POST["lastname"]);
        $findOrder->setAddress($_POST["address"]);
        $findOrder->setPostalCode($_POST["postal_code"]);
        $findOrder->setCity($_POST["city"]);
        $findOrder->setCountry($_POST["country"]);
        $findOrder->setPhone($_POST["phone"]);
        $findOrder->save();
        header("Location: /admin/orders");
        return;
      }

      $orderEdit->setId($_GET["id"]);
      $view = new View("admin-orders-manage", "back");
      $view->assign("user", $user);
      $view->assign("order", $orderEdit);
      $view->assign("title", "Modifier une commande 📦");
      $view->assign("titleSeo", "Modifier une commande");
    } else {
      header("Location: /dashboard");
      exit;
    }
  }

  public function payment()
  {
    $user = Auth::getUser();
    $cart = new Cart();
    $cart = $cart->getCart();
    $products = new ProductModel();

    if (Auth::isLogged()) {
      $result = [];
      if (!empty($_POST)) {
        if (empty($_POST["name"]) || empty($_POST["lastname"]) || empty($_POST["address"]) || empty($_POST["postal_code"]) || empty($_POST["city"]) || empty($_POST["country"]) || empty($_POST["phone"])) {
          $result[] = "Veuillez remplir tous les champs";
        }

        if (!preg_match("/^0[1-9]([-. ]?[0-9]{2}){4}$/", $_POST["phone"])) {
          $result[] = "Veuillez entrer un numéro de téléphone valide";
        }

        if (!preg_match("/^[a-zA-Z-_ ]+$/", $_POST["name"])) {
          $result[] = "Veuillez entrer un prénom valide";
        }

        if (!preg_match("/^[a-zA-Z-_ ]+$/", $_POST["lastname"])) {
          $result[] = "Veuillez entrer un nom valide";
        }

        if (!preg_match("/^[a-zA-Z0-9-_ ]+$/", $_POST["address"])) {
          $result[] = "Veuillez entrer une adresse valide";
        }

        if (!preg_match("/^[a-zA-Z0-9-_ ]+$/", $_POST["postal_code"])) {
          $result[] = "Veuillez entrer un code postal valide";
        }

        if (!preg_match("/^[a-zA-Z-_ ]+$/", $_POST["city"])) {
          $result[] = "Veuillez entrer une ville valide";
        }

        if (!preg_match("/^[a-zA-Z-_ ]+$/", $_POST["country"])) {
          $result[] = "Veuillez entrer un pays valide";
        }


        if ($result) {
          $view = new View("payments", "front");
          $view->assign("titleSeo", "Paiement");
          $view->assign("user", $user);
          $view->assign("cart", $cart);
          $view->assign("products", $products);
          $view->assign("error", true);
          $view->assign("errorMessage", "Le paiement n'a pas pu être effectué pour les raisons suivantes :");
          $view->assign("listErrors", $result);
          return;
        }

        $settings = new Settings();
        $cart = new Cart();
        $cart = $cart->getCart();
        $total = 0;
        $products = new ProductModel();

        foreach ($cart as $product => $quantity) {
          $findProduct = $products->find('id', $product);
          $total = $total + ($findProduct->price * $quantity);
        }

        $gateway = Omnipay::create('Stripe\PaymentIntents');
        $gateway->initialize([
          'apiKey' => $settings->getSetting('stripe_private_key')
        ]);

        $payment = new OrderModel();

        $completePaymentUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/order/complete';

        if (isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) {
          try {
            $token = $_POST['stripeToken'];

            $response = $gateway->purchase([
              'amount'                   =>  $total,
              'currency'                 => $settings->getSetting('currency'),
              'token'                    => $token,
              'returnUrl'                => $completePaymentUrl,
              'confirm'                  => true
            ])->send();

            $payment->setAmount($total);
            $payment->setCurrency($settings->getSetting('currency'));
            $payment->setPaymentId($response->getPaymentIntentReference());
            $payment->setPaymentStatus('PENDING');
            $payment->setName($_POST['name']);
            $payment->setLastname($_POST['lastname']);
            $payment->setAddress($_POST['address']);
            $payment->setPostalCode($_POST['postal_code']);
            $payment->setCity($_POST['city']);
            $payment->setCountry($_POST['country']);
            $payment->setPhone($_POST['phone']);
            $payment->setUserId(Auth::getUser()->getId());
            $payment->save();

            $payment = $payment->find('payment_id', $response->getPaymentIntentReference(), OrderModel::class);

            $orderContent = new OrderContentModel();
            foreach ($cart as $product => $quantity) {
              $orderContent->setOrderId($payment->getId());
              $orderContent->setProductId($product);
              $orderContent->setQuantity($quantity);
              $orderContent->save();
            }

            if ($response->isSuccessful()) {
              // payment was successful: update database
              $arr_payment_data = $response->getData();
              $payment_id = $arr_payment_data['id'];

              // Insert transaction data into the database
              $isPaymentExist = $payment->find('payment_id', $payment_id, OrderModel::class);

              if ($isPaymentExist) {
                $isPaymentExist->setPaymentStatus('PAID');
                $isPaymentExist->save();
              }

              $cart->clearCart();

              $view = new View("payment-successful", "front");
              $view->assign("titleSeo", "Paiement validé");
              $view->assign("user", $user);

              $email = new Email();
              $email->to = $user->getEmail();
              $email->name = $user->getFirstname() . " " . $user->getLastname();
              $email->subject = "Votre commande a été validée";
              $email->body = "Bonjour " . $user->getFirstname() . " " . $user->getLastname() . ",<br><br>
                              Votre commande a été validée.<br><br>
                              La numéro de votre commande est : " . $payment->getId() . "<br><br>
                              La référence de votre paiement (banque) est : " . $payment_id . "<br><br>
                              
                              Vous pouvez suivre l'avancement de votre commande sur votre espace personnel.<br><br>
                              Cordialement,<br><br>";
              $email->send();
            } else if ($response->isRedirect()) {
              // redirect to offsite payment gateway
              $response->redirect();
            } else {
              // payment failed: display message to customer
              $user = Auth::getUser();
              $view = new View("payment-failed", "front");
              $view->assign("titleSeo", "Paiement échoué");
              $view->assign("user", $user);
            }
          } catch (Exception $e) {
            echo $e->getMessage();
          }
          return;
        }
      }

      $view = new View("payments", "front");
      $view->assign("titleSeo", "Paiement");
      $view->assign("user", $user);
      $view->assign("cart", $cart);
      $view->assign("products", $products);
    } else {
      $user = new User();
      $view = new View("login", "auth");
      $view->assign("user", $user);
      $view->assign("error", true);
      $view->assign("errorMessage", "Vous devez être connecté pour effectuer une commande");
    }
  }

  public function complete()
  {
    $user = Auth::getUser();
    if (!empty($_GET)) {
      $settings = new Settings();
      $cart = new Cart();
      $gateway = Omnipay::create('Stripe\PaymentIntents');
      $gateway->initialize([
        'apiKey' => $settings->getSetting('stripe_private_key')
      ]);

      $completePaymentUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/order/complete';

      $payment = new OrderModel();

      $payment = $payment->find('payment_id', $_GET['payment_intent'], OrderModel::class);

      $response = $gateway->confirm([
        'paymentIntentReference' =>  $_GET['payment_intent'],
        'returnUrl' => $completePaymentUrl,
      ])->send();

      if ($response->isSuccessful()) {
        // payment was successful: update database

        $payment->setPaymentStatus('PAID');
        $payment->save();

        $cart->clearCart();

        $view = new View("payment-successful", "front");
        $view->assign("titleSeo", "Paiement validé");
        $view->assign("user", $user);

        $email = new Email();
        $email->to = $user->getEmail();
        $email->name = $user->getFirstname() . " " . $user->getLastname();
        $email->subject = "Votre commande a été validée";
        $email->body = "Bonjour " . $user->getFirstname() . " " . $user->getLastname() . ",<br><br>
                        Votre commande a été validée.<br><br>
                        La numéro de votre commande est : " . $payment->getId() . "<br><br>
                        La référence de votre paiement (banque) est : " . $_GET['payment_intent'] . "<br><br>
                        
                        Vous pouvez suivre l'avancement de votre commande sur votre espace personnel.<br><br>
                        Cordialement,<br><br>";
        $email->send();
      }
    }
  }
}
