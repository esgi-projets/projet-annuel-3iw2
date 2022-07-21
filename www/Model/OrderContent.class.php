<?php

namespace App\Model;

use App\Core\BaseSQL;

class OrderContent extends BaseSQL
{

  protected $id = null;
  protected $orderId;
  protected $productId;
  protected $quantity;
  protected $createdAt;
  protected $updatedAt;

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

  public function getOrderId(): ?int
  {
    return $this->orderId;
  }

  /**
   * @param mixed $orderId
   */

  public function setOrderId($orderId): object
  {
    $this->orderId = $orderId;
    return $this;
  }

  /**
   * @return mixed
   */

  public function getProductId(): ?int
  {
    return $this->productId;
  }

  /**
   * @param mixed $productId
   */

  public function setProductId($productId): object
  {
    $this->productId = $productId;
    return $this;
  }

  /**
   * @return mixed
   */

  public function getQuantity(): ?int
  {
    return $this->quantity;
  }

  /**
   * @param mixed $quantity
   */

  public function setQuantity($quantity): object
  {
    $this->quantity = $quantity;
    return $this;
  }

  /**
   * @return mixed
   */

  public function getCreatedAt(): ?string
  {
    return $this->createdAt;
  }

  /**
   * @param mixed $createdAt
   */

  public function getUpdatedAt(): string
  {
    return $this->updatedAt;
  }

  /**
   * @param mixed $updatedAt
   */
}
