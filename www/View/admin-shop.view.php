<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Réglages généraux</h1>
  <h3 class="color-gray pl-8">Cette section permet de configurer les paramètres généraux de votre boutique.</h3>
  <div class="row">
    <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs px-8 pt-2">
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Titre du site</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input class="w-80"></input>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le titre sera visible dans le menu et sur l’intégralité de votre site. Cela comprends aussi les moteurs de recherche.</div>
      </label>
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Slogan</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input class="w-80"></input>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le slogan sera visble dans le footer. En quelques mots, décrivez la raison d’être de ce site.</div>
      </label>
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray pr-2">Description du site</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <textarea class="w-80 h-10" rows="10" cols="80"></textarea>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette description pourra être visible par les moteurs de recherche. Faîtes une description concise.</div>
      </label>
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Logo du site</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <div class="w-80 button button-secondary">
            <span id="text">Changer le logo</span>
            <input type="file" class="hidden file" accept="image/*" />
          </div>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le logo sera visible dans le menu et sur l’intégralité de votre site. Cela comprends aussi les moteurs de recherche.</div>
      </label>
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Image de fond</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <div class="w-80 button button-secondary">
            <span id="text">Changer l'image de fond</span>
            <input type="file" class="hidden file" accept="image/*" />
          </div>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">L'image de fond correspond à l'image de fond de la page de connexion / inscription.</div>
      </label>
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-4-sm col-4-xs color-gray">Autoriser les avis sur les produits</div>
        <div class="col-6-xl col-6-lg col-6-md col-6-sm col-6-xs">
          <label class="switch ml-5">
            <input type="checkbox">
            <span class="slider round"></span>
          </label>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette option est conseillée pour booster vos ventes ! Les avis sont un moyen efficace pour vos clients de se faire une opinion rapide.</div>
      </label>
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-4-sm col-4-xs color-gray">Visibilité sur les moteurs de recherche</div>
        <div class="col-6-xl col-6-lg col-6-md col-6-sm col-6-xs">
          <label class="switch ml-5">
            <input type="checkbox">
            <span class="slider round"></span>
          </label>
        </div>
      </label>

      <hr class="mt-16">
    </div>
    <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs pl-4 pr-4 pb-4">
      <h1>Réglages de la boutique</h1>
      <h3 class="color-gray pl-4">Pour recevoir des commandes, vous devez configurer les informations de votre compte Stripe.</h3>

      <label class="button-icon pl-4 mb-4 mt-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Clé publique Stripe</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input class="w-80" placeholder="pk_test_..."></input>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette clé publique Stripe est utilisée pour l'envoi de paiements.</div>
      </label>

      <label class="button-icon pl-4 mb-4 mt-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Clé privée Stripe</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input class="w-80" placeholder="sk_test_..."></input>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette clé privée Stripe ne doit pas être communiquée à personne.</div>
      </label>

      <label class="button-icon pl-4 mb-4 mt-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Devise par défaut</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <select class="w-80">
            <option value="EUR">EUR</option>
            <option value="USD">USD</option>
            <option value="GBP">GBP</option>
            <option value="CHF">CHF</option>
            <option value="JPY">JPY</option>
            <option value="CAD">CAD</option>
            <option value="AUD">AUD</option>
            <option value="NZD">NZD</option>
            <option value="HKD">HKD</option>
            <option value="SGD">SGD</option>
            <option value="SEK">SEK</option>
            <option value="DKK">DKK</option>
            <option value="NOK">NOK</option>
            <option value="HUF">HUF</option>
            <option value="CZK">CZK</option>
            <option value="ILS">ILS</option>
            <option value="MXN">MXN</option>
            <option value="BRL">BRL</option>
            <option value="PHP">PHP</option>
            <option value="MYR">MYR</option>
            <option value="THB">THB</option>
            <option value="TRY">TRY</option>
            <option value="RUB">RUB</option>
            <option value="PLN">PLN</option>
            <option value="KRW">KRW</option>
            <option value="INR">INR</option>
            <option value="TWD">TWD</option>
            <option value="IDR">IDR</option>
            <option value="CNY">CNY</option>
            <option value="BGN">BGN</option>
            <option value="EUR">EUR</option>
            <option value="USD">USD</option>
            <option value="GBP">GBP</option>
            <option value="CHF">CHF</option>
          </select>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette devise sera utilisée pour les paiements.</div>
      </label>
    </div>

    <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs mt-2 mr-4 ml-4 mb-4">
      <input type="submit" class="button button-primary w-100 h-90 mt-3" value="Enregister tous les paramètres"></input>
    </div>
  </div>