<?php

namespace App\Model;

use App\Core\BaseSQL;

class Order extends BaseSQL
{

  protected $id = null;
  protected $payment_id;
  protected $amount;
  protected $currency;
  protected $payment_status;
  protected $name;
  protected $lastname;
  protected $address;
  protected $postal_code;
  protected $city;
  protected $country;
  protected $phone;
  protected $user_id;
  protected $captured_at;

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * @return mixed
   */

  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */

  public function setId($id): object
  {
    $this->id = $id;
    parent::populate();
    return $this;
  }

  /**
   * @return mixed
   */

  public function getPaymentId(): string
  {
    return $this->payment_id;
  }

  /**
   * @param mixed $payment_id
   */

  public function setPaymentId($payment_id): void
  {
    $this->payment_id = $payment_id;
  }

  /**
   * @return mixed
   */

  public function getAmount(): float
  {
    return $this->amount;
  }

  /**
   * @param mixed $amount
   */

  public function setAmount($amount): void
  {
    $this->amount = $amount;
  }

  /**
   * @return mixed
   */

  public function getCurrency(): string
  {
    return $this->currency;
  }

  /**
   * @param mixed $currency
   */

  public function setCurrency($currency): void
  {
    $this->currency = $currency;
  }

  /**
   * @return mixed
   */

  public function getPaymentStatus(): string
  {
    return $this->payment_status;
  }

  /**
   * @param mixed $payment_status
   */

  public function setPaymentStatus($payment_status): void
  {
    $this->payment_status = $payment_status;
  }

  /**
   * @return mixed
   */

  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */

  public function setName($name): void
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */

  public function getLastname(): string
  {
    return $this->lastname;
  }

  /**
   * @param mixed $lastname
   */

  public function setLastname($lastname): void
  {
    $this->lastname = $lastname;
  }

  /**
   * @return mixed
   */

  public function getAddress(): string
  {
    return $this->address;
  }

  /**
   * @param mixed $address
   */

  public function setAddress($address): void
  {
    $this->address = $address;
  }

  /**
   * @return mixed
   */

  public function getPostalCode(): string
  {
    return $this->postal_code;
  }

  /**
   * @param mixed $postal_code
   */

  public function setPostalCode($postal_code): void
  {
    $this->postal_code = $postal_code;
  }

  /**
   * @return mixed
   */

  public function getCity(): string
  {
    return $this->city;
  }

  /**
   * @param mixed $city
   */

  public function setCity($city): void
  {
    $this->city = $city;
  }

  /**
   * @return mixed
   */

  public function getCountry(): string
  {
    return $this->country;
  }

  /**
   * @param mixed $country
   */

  public function setCountry($country): void
  {
    $this->country = $country;
  }

  /**
   * @return mixed
   */

  public function getPhone(): string
  {
    return $this->phone;
  }

  /**
   * @param mixed $phone
   */

  public function setPhone($phone): void
  {
    $this->phone = $phone;
  }

  /**
   * @return mixed
   */

  public function getUserId(): int
  {
    return $this->user_id;
  }

  /**
   * @param mixed $user_id
   */

  public function setUserId($user_id): void
  {
    $this->user_id = $user_id;
  }

  /**
   * @return mixed
   */


  public function getCapturedAt(): string
  {
    return $this->captured_at;
  }

  public function getFormOrderEdit($order = null): array
  {
    return [
      "config" => [
        "method" => "POST",
        "action" => "",
        "submit" => "Enregistrer",
        "class" => "w-90 mb-5 ml-5",
        "model" => get_class($this)
      ],
      "inputs" => [
        "name" => [
          "name" => "Prénom",
          "type" => "text",
          "placeholder" => "Charles",
          "id" => "name",
          "class" => "input w-100",
          "value" => $order ? $order->getName() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "Le nom semble incorrect",
        ],
        "lastname" => [
          "name" => "Nom de famille",
          "type" => "text",
          "placeholder" => "Leclerc",
          "id" => "lastname",
          "class" => "input w-100",
          "value" => $order ? $order->getLastname() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "La description semble incorrect",
        ],
        "address" => [
          "name" => "Adresse",
          "type" => "text",
          "placeholder" => "12 rue de la paix",
          "id" => "address",
          "class" => "input w-100",
          "value" => $order ? $order->getAddress() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "L'adresse semble incorrecte",
        ],
        "postal_code" => [
          "name" => "Code postal",
          "type" => "text",
          "placeholder" => "75000",
          "id" => "postal_code",
          "class" => "input w-100",
          "value" => $order ? $order->getPostalCode() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "Le code postal semble incorrect",
        ],
        "city" => [
          "name" => "Ville",
          "type" => "text",
          "placeholder" => "Paris",
          "id" => "city",
          "class" => "input w-100",
          "value" => $order ? $order->getCity() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "La ville semble incorrecte",
        ],
        "country" => [
          "name" => "Pays",
          "type" => "text",
          "placeholder" => "France",
          "id" => "country",
          "class" => "input w-100",
          "value" => $order ? $order->getCountry() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "Le pays semble incorrect",
        ],
        "phone" => [
          "name" => "Téléphone",
          "type" => "text",
          "placeholder" => "0612345678",
          "id" => "phone",
          "class" => "input w-100",
          "value" => $order ? $order->getPhone() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "Le téléphone semble incorrect",
        ],
        "captured_at" => [
          "name" => "Date de commande",
          "type" => "text",
          "placeholder" => "2020-01-01",
          "id" => "captured_at",
          "class" => "input w-100",
          "value" => $order ? $order->getCapturedAt() : '',
          "min" => 2,
          "max" => 50,
          "required" => false,
          "disabled" => false,
          "error" => "La date de commande semble incorrecte",
        ],
        "user_id" => [
          "name" => "Utilisateur",
          "type" => "text",
          "placeholder" => "1",
          "id" => "user_id",
          "class" => "input w-100",
          "value" => $order ? $order->getUserId() : '',
          "min" => 2,
          "max" => 50,
          "required" => false,
          "disabled" => false,
          "error" => "L'utilisateur semble incorrect",
        ],
        "amount" => [
          "name" => "Montant total",
          "type" => "text",
          "placeholder" => "100",
          "id" => "amount",
          "class" => "input w-100",
          "value" => $order ? $order->getAmount() . $order->getCurrency() : '',
          "min" => 2,
          "max" => 50,
          "required" => false,
          "disabled" => false,
          "error" => "Le montant semble incorrect",
        ],
        "payment_status" => [
          "name" => "Statut de paiement",
          "type" => "text",
          "placeholder" => "Paiement effectué",
          "id" => "payment_status",
          "class" => "input w-100",
          "value" => $order ? $order->getPaymentStatus() : '',
          "min" => 2,
          "max" => 50,
          "required" => false,
          "disabled" => false,
          "error" => "Le statut de paiement semble incorrect",
        ],
        "payment_id" => [
          "name" => "Identifiant de paiement",
          "type" => "text",
          "placeholder" => "123456789",
          "id" => "payment_id",
          "class" => "input w-100",
          "value" => $order ? $order->getPaymentId() : '',
          "min" => 2,
          "max" => 50,
          "required" => false,
          "disabled" => false,
          "error" => "L'identifiant de paiement semble incorrect",
        ],
        "id" => [
          "type" => "hidden",
          "id" => "id",
          "value" => $order->id ?? "",
          "required" => false,
        ],
      ]

    ];
  }
}
