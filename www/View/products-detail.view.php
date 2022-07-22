<div class="col-12-xl mx-auto">
  <div class="row product-content-box">
    <?php $productDetail = $product->find('id', $_GET['id']); ?>
    <img class="image-product-detail" src="/assets/images/products/<?= $productDetail->image ?>">
    <div class="product-details">
      <h1 class="pt-2 mb-0"><?= $productDetail->name ?></h1>
      <div class="">
        <h2 class="font-900 color-gray"><?= $productDetail->price ?> €</h2>
        <p class="font-400 color-gray"><?= $productDetail->description ?></p>
      </div>
      <div class="quantity-box">
        <select name="quantity" id="quantity">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
        <button class="button button-primary w-100" id="add-to-cart" data-id="<?= $_GET['id'] ?>">Ajouter au panier</button>
      </div>
      <div id="success" class="w-100 h-10 mt-5 mb-5 px-5 bg-success-pastel border-radius-1" hidden>
        <h3 class="font-700 color-success">Ajouté au panier</h3>
      </div>
    </div>
  </div>
</div>