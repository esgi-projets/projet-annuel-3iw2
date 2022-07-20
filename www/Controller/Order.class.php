<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\User;
use App\Model\Order as OrderModel;
use Omnipay\Omnipay;


class Order
{
  public function payment()
  {
    if (!empty($_POST)) {
      $gateway = Omnipay::create('Stripe\PaymentIntents');
      $gateway->initialize([
        'apiKey' => $_ENV['STRIPE_API_KEY'],
      ]);

      $payment = new OrderModel();

      $completePaymentUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/order/complete';

      if (isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) {

        try {
          $token = $_POST['stripeToken'];

          $response = $gateway->purchase([
            'amount'                   => $_POST['amount'],
            'currency'                 => 'EUR',
            'token'            => $token,
            'returnUrl'                => $completePaymentUrl,
            'confirm'                  => true
          ])->send();

          $payment->setAmount($_POST['amount']);
          $payment->setCurrency('EUR');
          $payment->setPaymentId($response->getPaymentIntentReference());
          $payment->setPaymentStatus('PENDING');
          $payment->save();

          if ($response->isSuccessful()) {
            // payment was successful: update database
            $arr_payment_data = $response->getData();
            $payment_id = $arr_payment_data['id'];

            // Insert transaction data into the database
            $isPaymentExist = $payment->find('payment_id', $payment_id);

            if ($isPaymentExist) {
              $payment->setPaymentStatus('PAID');
              $payment->save();
            }

            echo "Payment is successful. Your payment id is: " . $payment_id;
          } else if ($response->isRedirect()) {
            // redirect to offsite payment gateway
            $response->redirect();
          } else {
            // payment failed: display message to customer
            echo $response->getMessage();
          }
        } catch (Exception $e) {
          echo $e->getMessage();
        }
        return;
      }
    }

    $user = Auth::getUser();
    $view = new View("payments", "front");
    $view->assign("titleSeo", "Paiement");
    $view->assign("user", $user);
  }

  public function complete()
  {
    if (!empty($_GET)) {
      $gateway = Omnipay::create('Stripe\PaymentIntents');
      $gateway->initialize([
        'apiKey' => $_ENV['STRIPE_API_KEY'],
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
        echo "Payment is successful. Your payment id is: " . $payment->getPaymentId();

        $payment->setPaymentStatus('PAID');
        $payment->save();
      }
    }
  }

  public function confirmation()
  {
    $user = Auth::getUser();
    $view = new View("confirmation", "front");
    $view->assign("titleSeo", "Confirmation");
    $view->assign("user", $user);
  }
}
