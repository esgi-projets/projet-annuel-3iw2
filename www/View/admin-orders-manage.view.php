<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8"><?= $title ?></h1>
  <div class="pr-2 pl-2">
    <?php
    $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
    $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
    ?>
  </div>
  <?php
  $this->includePartial("form", $order->getFormOrderEdit($order->getId() ? $order : null)) ?>
  <a class="button button-link--success w-90 mb-5 ml-5" href="/order/details/<?= $order->getId() ?>">Voir le détail de la commande</a>
</div>