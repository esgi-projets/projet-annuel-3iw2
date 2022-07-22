<link rel="stylesheet" href="style.css">
<script src="https://js.stripe.com/v3/"></script>

<div class="col-12-xl mx-auto pt-10">
  <div>
    <h1 class="pl-1">Finaliser votre commande</h1>
    <div class=" bg-primary h-10 w-75 ml-28">
    </div> <!-- line under welcome -->
  </div>
  <div class="mr-6 ml-6">
    <?php
    $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
    ?>
  </div>
  <form action="payment" method="post" id="payment-form">
    <div class="form-row">
      <div class="line">
        <input type="text" name="name" class="form-control mr-1 mb-5 StripeElement StripeElement--empty w-100" placeholder="Prénom">
        <input type="text" name="lastname" class="form-control mb-5 StripeElement StripeElement--empty w-100" placeholder="Nom">
      </div>
      <input type="text" name="address" class="form-control mb-5 StripeElement StripeElement--empty w-100" placeholder="Adresse">
      <div class="line">
        <input type="text" name="postal_code" class="form-control mr-1 mb-5 StripeElement StripeElement--empty w-100" placeholder="Code postal">
        <input type="text" name="city" class="form-control mr-1 mb-5 StripeElement StripeElement--empty w-100" placeholder="Ville">
        <input type="text" name="country" class="form-control mb-5 StripeElement StripeElement--empty w-100" placeholder="Pays">
      </div>
      <label for="card-element">
        <h2 class="mb-2 color-gray mt-2 mb-4">Votre moyen de paiement</h2>
      </label>

      <div class="line">
        <div id="card-element" class="w-50">
          <!-- A Stripe Element will be inserted here. -->
        </div>
        <input type="phone" name="phone" class="form-control ml-1 StripeElement StripeElement--empty w-100" placeholder="Téléphone">
      </div>

      <!-- Used to display form errors. -->
      <div id="card-errors" role="alert"></div>
    </div>
    <hr class="mb-4 mt-8">
    <h2 class="mb-2">Récapitulatif de votre commande</h2>
    <table class="mt-5" id="table-products">
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

    <div class="row mt-8 mb-5">
      <h1 class="font-700 color-gray">Total TTC : <span class="color-primary"><?= $total ?> €</span></h1>
      <input type="submit" class="button button-primary w-30 h-10 ml-auto" id="pay" value="Valider ma commande">
    </div>
  </form>
</div>

<script>
  // Create a Stripe client.
  var stripe = Stripe('<?= $settings->getSetting('stripe_public_key') ?>');

  // Create an instance of Elements.
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
  var style = {
    base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };

  // Create an instance of the card Element.
  var card = elements.create('card', {
    style: style
  });

  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');

  // Handle real-time validation errors from the card Element.
  card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  // Handle form submission.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
      if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
      }
    });
  });

  // Submit the form with the token ID.
  function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
  }
</script>