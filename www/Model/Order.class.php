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

  public function getCapturedAt(): string
  {
    return $this->captured_at;
  }

  /**
   * @param mixed $captured_at
   */
}
