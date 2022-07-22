<?php

namespace App\Model;

use App\Core\BaseSQL;

class Products extends BaseSQL
{
  protected $id = null;
  protected $name;
  protected $description;
  protected $image;
  protected $stock;
  protected $price;
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
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * @param mixed $description
   */
  public function setDescription($description): void
  {
    $this->description = $description;
  }

  /**
   * @return mixed
   */
  public function getImage(): string
  {
    return $this->image;
  }

  /**
   * @param mixed $image
   */
  public function setImage($image): void
  {
    $this->image = $image;
  }

  /**
   * @return mixed
   */
  public function getStock(): int
  {
    return $this->stock;
  }

  /**
   * @param mixed $stock
   */
  public function setStock($stock): void
  {
    $this->stock = $stock;
  }

  /**
   * @return mixed
   */
  public function getPrice(): float
  {
    return $this->price;
  }

  /**
   * @param mixed $price
   */
  public function setPrice($price): void
  {
    $this->price = $price;
  }

  /**
   * @return mixed
   */

  public function getCreatedAt(): string
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

  public function setProduct($name, $value): void
  {
    $this->name = $name;
    $this->value = $value;
  }

  /**
   * @return mixed
   */

  public function deleteRecord(): void
  {
    parent::__construct();
    parent::deleteRecord();
  }

  /**
   * @return mixed
   */

  public function getFormProduct($product = null): array
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
          "name" => "Nom du produit",
          "type" => "text",
          "placeholder" => "Produit",
          "id" => "name",
          "class" => "input w-100",
          "value" => $product ? $product->getName() : '',
          "min" => 2,
          "max" => 50,
          "required" => true,
          "error" => "Le nom semble incorrect",
        ],
        "description" => [
          "name" => "Description",
          "type" => "text",
          "placeholder" => "Description",
          "id" => "description",
          "class" => "input w-100",
          "value" => $product ? $product->getDescription() : '',
          "required" => false,
          "error" => "La description semble incorrect",
        ],
        "image" => [
          "name" => "Image",
          "type" => "file",
          "placeholder" => "Image du produit",
          "id" => "image",
          "class" => "input w-100",
          "value" => $product ? $product->getImage() : '',
          "required" => false,
          "error" => "L'image semble incorrect",
        ],
        "stock" => [
          "name" => "Stock",
          "type" => "number",
          "placeholder" => "...",
          "id" => "stock",
          "class" => "input w-100",
          "value" => $product ? $product->getStock() : '',
          "required" => true,
          "error" => "Le stock est invalide"
        ],
        "price" => [
          "name" => "Prix",
          "type" => "number",
          "step" => "0.01",
          "id" => "price",
          "class" => "input w-100",
          "value" => $product ? $product->getPrice() : '',
          "placeholder" => "12.99",
          "required" => true,
          "error" => "Le prix indiqué n'est pas valide",
        ],
        "id" => [
          "type" => "hidden",
          "id" => "id",
          "value" => $product->id ?? "",
          "required" => false,
        ],
      ]

    ];
  }
}
