<?php

namespace App\Model;

use App\Core\BaseSQL;

class Menu extends BaseSQL
{

  protected $id = null;
  protected $title;
  protected $href;
  protected $page_id;

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
  public function getHref(): string
  {
    return $this->href;
  }

  /**
   * @param mixed $href
   */
  public function setHref($href): void
  {
    $this->href = $href;
  }

  /**
   * @return mixed
   */
  public function getPageId(): ?int
  {
    return $this->page_id;
  }

  /**
   * @param mixed $page_id
   */
  public function setPageId($page_id): object
  {
    $this->page_id = $page_id;
    parent::populate();
    return $this;
  }

  /**
   * @return mixed
   */
  public function deleteRecord(): void
  {
    parent::__construct();
    parent::deleteRecord();
  }

  public function getFormMenu($menu = null): array
  {
    $pages = new Page();
    $pages = $pages->findAll($this);

    $options['none'] = 'Ne pas lier à une page';

    foreach ($pages as $page) {
      $options[$page->id] = $page->title;
    }

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
          "placeholder" => "Contact",
          "id" => "title",
          "class" => "input w-100",
          "value" => $menu ? $menu->getTitle() : "",
          "required" => true,
        ],
        "page" => [
          "name" => "Lier à une page",
          "type" => "select",
          "id" => "page",
          "class" => "input w-100",
          "value" => $menu ? $options[$menu->getPageId()] : "",
          "options" => $options,
        ],
        "href" => [
          "name" => "Lien externe (si page non liée)",
          "type" => "text",
          "id" => "href",
          "class" => "input w-100",
          "placeholder" => "https://google.fr",
          "value" => $menu ? $menu->getHref() : "",
        ],
        "position" => [
          "type" => "hidden",
          "id" => "id",
          "value" => $menu->position ?? "",
          "required" => true,
        ],
        "id" => [
          "type" => "hidden",
          "id" => "id",
          "value" => $menu->id ?? "",
          "required" => false,
        ],
      ]
    ];
  }
}
