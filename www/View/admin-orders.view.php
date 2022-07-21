<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Toutes les commandes 📦</h1>
</div>
<div class="table col-12-xl mx-auto">
  <table class="mt-5" id="table-orders">
    <thead>
      <tr>
        <th scope="col">
          <div class="text-center">
            Date de la commande
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            ID
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Adresse
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Prix total
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Status
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Action
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
      $findOrders = $orders->findAllBy('user_id', $user->getId(), OrderModel::class);
      if ($user->getRole() === "admin") {
        $findOrders = $orders->findAll();
      }
      foreach ($findOrders as $order) : ?>

        <tr>
          <td data-label="Date"><?= $order->captured_at ?></td>
          <td data-label="ID"><?= $order->id ?></td>
          <td data-label="Adresse"><?= $order->name . ' ' . $order->lastname . ' ' . $order->address . ' ' . $order->postal_code . ' ' . $order->city . ' ' . $order->country ?> </td>
          <td data-label="Prix Total"><?= $order->amount . ' ' . $order->currency ?></td>
          <td data-label="Status">
            <div class="status status-success"><?= $order->payment_status ?></div>
          </td>
          <td data-label="Action">
            <div class="action">
              <button class="button-icon">
                Consulter
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg></button>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#table-orders').DataTable();
  });
</script>