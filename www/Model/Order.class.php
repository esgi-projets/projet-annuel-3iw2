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
}
