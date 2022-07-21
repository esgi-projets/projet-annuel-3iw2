<?php

namespace App\Model;

use App\Core\BaseSQL;

class Settings extends BaseSQL
{

  protected $id = null;
  protected $name;
  protected $value;

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
   * @return mixed
   */

  public function getValue(): string
  {
    return $this->value;
  }

  /**
   * @param mixed $name
   */
  public function setName($name): void
  {
    $this->name = $name;
  }

  /**
   * @param mixed $value
   */
  public function setValue($value): void
  {
    $this->value = $value;
  }

  /**
   * @return mixed
   */
  public function getSetting($name)
  {
    $find = $this->find('name', $name);
    return $find->value ?? "";
  }

  /**
   * @param mixed $name
   */
  public function setSetting($name, $value): void
  {
    $this->name = $name;
    $this->value = $value;
  }

  public function getFormSettings(): array
  {
    return [
      "config" => [
        "method" => "POST",
        "action" => "",
        "submit" => "Enregistrer",
        "class" => "w-90 mb-5 ml-5",
        "model" => $this
      ],
      "inputs" => [
        "email_grant" => [
          "name" => "Email administrateur installation",
          "type" => "text",
          "placeholder" => "Email administrateur installation",
        ],
        "title" => [
          "name" => "Titre",
          "type" => "text",
          "id" => "title",
          "class" => "input w-100",
          "required" => true,
        ],
        "slogan" => [
          "name" => "Slogan",
          "type" => "text",
          "id" => "slogan",
          "class" => "input w-100",
          "required" => true,
        ],
        "description" => [
          "name" => "Description",
          "type" => "text",
          "id" => "description",
          "class" => "input w-100",
          "required" => false,
        ],
        "visibility_search_engine" => [
          "name" => "Visibilité du site dans les moteurs de recherche",
          "type" => "checkbox",
          "id" => "visibility_search_engine",
          "class" => "input w-100",
          "required" => false,
        ],
        "allow_reviews" => [
          "name" => "Autoriser les commentaires",
          "type" => "checkbox",
          "id" => "allow_reviews",
          "class" => "input w-100",
          "required" => false,
        ],
        "stripe_public_key" => [
          "name" => "Clé publique Stripe",
          "type" => "text",
          "id" => "stripe_public_key",
          "class" => "input w-100",
          "required" => false,
        ],
        "stripe_private_key" => [
          "name" => "Clé privée Stripe",
          "type" => "text",
          "id" => "stripe_private_key",
          "class" => "input w-100",
          "required" => false,
        ],
        "currency" => [
          "name" => "Devise",
          "type" => "text",
          "id" => "currency",
          "class" => "input w-100",
          "required" => false,
        ],
        "smtp_email" => [
          "name" => "Email SMTP",
          "type" => "text",
          "id" => "smtp_email",
          "class" => "input w-100",
          "required" => true,
        ],
        "smtp_url" => [
          "name" => "URL SMTP",
          "type" => "text",
          "id" => "smtp_url",
          "class" => "input w-100",
          "required" => true,
        ],
        "smtp_port" => [
          "name" => "Port SMTP",
          "type" => "text",
          "id" => "smtp_port",
          "class" => "input w-100",
          "required" => true,
        ],
        "smtp_username" => [
          "name" => "Nom d'utilisateur SMTP",
          "type" => "text",
          "id" => "smtp_username",
          "class" => "input w-100",
          "required" => true,
        ],
        "smtp_password" => [
          "name" => "Mot de passe SMTP",
          "type" => "text",
          "id" => "smtp_password",
          "class" => "input w-100",
          "required" => true,
        ],
        "twitter_link" => [
          "name" => "Lien Twitter",
          "type" => "text",
          "id" => "twitter_link",
          "class" => "input w-100",
          "required" => false,
        ],
        "facebook_link" => [
          "name" => "Lien Facebook",
          "type" => "text",
          "id" => "facebook_link",
          "class" => "input w-100",
          "required" => false,
        ],
        "instagram_link" => [
          "name" => "Lien Instagram",
          "type" => "text",
          "id" => "instagram_link",
          "class" => "input w-100",
          "required" => false,
        ],
        "link_terms" => [
          "name" => "Lien conditions générales",
          "type" => "text",
          "id" => "link_terms",
          "class" => "input w-100",
          "required" => false,
        ],
        "link_privacy" => [
          "name" => "Lien politique de confidentialité",
          "type" => "text",
          "id" => "link_privacy",
          "class" => "input w-100",
          "required" => false,
        ],
      ]
    ];
  }
}
