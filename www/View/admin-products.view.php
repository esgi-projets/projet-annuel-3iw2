<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Toutes les produits 🧾</h1>
</div>
<div class="row mt-2 pr-3 pl-3 pb-2">
  <a class="ml-3 button button-tertiary" href='/admin/products/create'>Créer un produit</a>
</div>
<div class="table col-12-xl mx-auto">
  <table class="mt-5" id="table-products">
    <thead>
      <tr>
        <th scope="col">
          <div class="text-center">
            ID
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Nom du produit
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Description
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Image
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Stock
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Prix à l'unité
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
      <?php foreach ($products->findAll() as $product) : ?>
        <tr>
          <td class="wrap-long" data-label="ID"><?= $product->id ?></td>
          <td class="wrap-long" data-label="Nom du produit"><?= $product->name ?></td>
          <td class="wrap-long" data-label="Description"><?= $product->description ?></td>
          <td class="wrap-long" data-label="Image"><img class="img-product" src="/assets/images/products/<?= $product->image ?>"></td>
          <td class="wrap-long" data-label="Stock"><?= $product->stock ?></td>
          <td class="wrap-long" data-label="Prix à l'unité"><?= $product->price ?> EUR</td>
          <td data-label="Action">
            <div class="action">
              <a class="button-icon" href="/admin/products/edit/<?= $product->id ?>">
                Consulter
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg></a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#table-products').DataTable();
  });
</script>