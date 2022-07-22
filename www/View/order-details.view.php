<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Détail de votre commande 📦</h1>
</div>
<div class="table col-12-xl mx-auto">
  <table class="mt-5" id="table-orders-details">
    <thead>
      <tr>
        <th scope="col">
          <div class="text-center">
            Produit
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Image
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Quantité
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Prix
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Prix total
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
      $findContent = $orderContent->findAllBy('order_id', $_GET['id']);
      foreach ($findContent as $order) :
        $findProduct = $product->find('id', $order->product_id);
        $findCurrency = $orders->find('id', $order->order_id);
      ?>
        <tr>
          <td data-label="Produit"><?= $findProduct->name ?></td>
          <td class="wrap-long" data-label="Image"><img class="img-product" src="/assets/images/products/<?= $findProduct->image ?>"></td>
          <td data-label="Quantité"><?= $order->quantity ?></td>
          <td data-label="Prix"><?= $findProduct->price . ' ' . $findCurrency->currency ?> </td>
          <td data-label="Prix Total"><?php echo $findProduct->price * $order->quantity . ' ' . $findCurrency->currency ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#table-orders-details').DataTable();
  });
</script>