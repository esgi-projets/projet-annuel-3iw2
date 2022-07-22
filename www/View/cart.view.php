<div class="col-3-xl mx-auto w-95 pt-5">
  <h1 class="color-primary icon pt-3">
    <svg xmlns="http://www.w3.org/2000/svg" style="width: 36px; height:36px;" class="hidden-under-md mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
    </svg>
    Mon panier
  </h1>
  <div class="product-content-box">
    <table class="mt-5" id="table-cart">
      <thead>
        <tr>
          <th scope="col">
            <div class="text-center">
              Nom du produit
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
              Action
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0;
        foreach ($cart as $product => $quantity) :
          $findProduct = $products->find('id', $product);
          $total = $total + ($findProduct->price * $quantity); ?>
          <tr>
            <td class="wrap-long" data-label="Nom du produit"><a href="/products/detail/<?= $product->id ?>"><?= $findProduct->name ?></a></td>
            <td class="wrap-long" data-label="Image"><img class="img-product" src="/assets/images/products/<?= $findProduct->image ?>"></td>
            <td class="wrap-long" data-label="Quantité"><?= $quantity ?></td>
            <td class="wrap-long" data-label="Prix"><?php echo $findProduct->price * $quantity; ?>€</td>
            <td data-label="Action">
              <div class="action">
                <a class="button-icon color-error" href="/cart/remove?id=<?= $findProduct->id ?>&redirect=true">
                  Supprimer
                  <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg></a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <hr class="mt-5">
  <div class="row">
    <h1 class="font-700 color-grey">Total de votre panier : <span class="color-primary"><?= $total ?> €</span></h1>
    <button class="button <?= $total == 0 ? 'button-disabled' : 'button-primary' ?> w-30 mt-5 ml-auto" id="pay" <?php if ($total == 0) echo 'disabled' ?> onclick="window.location.href = '/payment'">Payer</button>
  </div>