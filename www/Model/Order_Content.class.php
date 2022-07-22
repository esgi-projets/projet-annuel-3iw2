<?php

namespace App\Model;

use App\Core\BaseSQL;

class Order_Content extends BaseSQL
{

  protected $id = null;
  protected $order_id;
  protected $product_id;
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
    return $this->order_id;
  }

  /**
   * @param mixed $orderId
   */

  public function setOrderId($orderId): object
  {
    $this->order_id = $orderId;
    return $this;
  }

  /**
   * @return mixed
   */

  public function getProductId(): ?int
  {
    return $this->product_id;
  }

  /**
   * @param mixed $productId
   */

  public function setProductId($productId): object
  {
    $this->product_id = $productId;
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
