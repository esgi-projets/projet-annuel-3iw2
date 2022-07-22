<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8 mt-3 color-primary">Tous nos produits</h1>
  <div class="row px-2">
    <?php
    $findProducts = $products->findAll();
    foreach ($findProducts as $product) : ?>
      <div class="card card-3 card-white card-shadow mx-auto">
        <?php if (!empty($product->image)) : ?>
          <img class="image-product" src="/assets/images/products/<?= $product->image ?>">
          <div class="">
          <?php else : ?>
            <div class="product-infos-bottom">
            <?php endif; ?>
            <h2 class="text-center pt-2 mb-5"><?= $product->name ?></h2>
            <div class="product-infos">
              <p class="font-400 color-gray"><?= $product->description ?></p>
              <h3 class="font-900 color-gray mt-5"><?= $product->price ?>€</h3>
            </div>
            <a class="button button-link mt-5 w-100" href="/products/detail/<?= $product->id ?>">Voir le produit</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
  </div>