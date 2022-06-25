<?php

namespace App\Model;

use App\Core\BaseSQL;

class Page extends BaseSQL
{

  protected $id = null;
  protected $title;
  protected $slug;
  protected $content;

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
  public function getTitle(): string
  {
    return $this->title;
  }

  /**
   * @param mixed $title
   */
  public function setTitle($title): void
  {
    $this->title = $title;
  }

  /**
   * @return mixed
   */
  public function getSlug(): string
  {
    return $this->slug;
  }

  /**
   * @param mixed $slug
   */
  public function setSlug($slug): void
  {
    $this->slug = $slug;
  }

  /**
   * @return mixed
   */
  public function getContent(): string
  {
    return $this->content;
  }

  /**
   * @param mixed $content
   */
  public function setContent($content): void
  {
    $this->content = $content;
  }

  /**
   * @return mixed
   */
  public function deleteRecord(): void
  {
    parent::__construct();
    parent::deleteRecord();
  }

  public function getFormPage($page = null): array
  {
    return [
      "config" => [
        "method" => "POST",
        "action" => "",
        "submit" => "Enregistrer",
        "class" => "w-100 mb-5",
        "model" => $this
      ],
      "inputs" => [
        "title" => [
          "name" => "Titre",
          "type" => "text",
          "placeholder" => "Mon article",
          "id" => "title",
          "class" => "input w-100",
          "value" => $page ? $page->getTitle() : "",
          "required" => true,
        ],
        "slug" => [
          "name" => "Slug (URL)",
          "type" => "text",
          "id" => "slug",
          "class" => "input w-100",
          "placeholder" => "/mon-article-de-blog",
          "value" => $page ? $page->getSlug() : "",
          "required" => true,
        ],
        "content" => [
          "name" => "Contenu de la page",
          "type" => "textarea",
          "id" => "content",
          "value" => $page ? $page->getContent() : "",
          "class" => "w-100",
        ],
      ]
    ];
  }
}
