<form enctype="multipart/form-data" action="" method="POST">
  <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
    <div class="mr-6 ml-6">
      <?php
      $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
      $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
      ?>
    </div>

    <h1 class="pl-8">Réglages généraux</h1>
    <h3 class="color-gray pl-8">Cette section permet de configurer les paramètres généraux de votre boutique.</h3>
    <div class="row">
      <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs px-8 pt-2">
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Titre du site</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="title" type="text" class="w-80" value="<?= $settings->getSetting('title') ?>" required></input>
          </div>
          <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le titre sera visible dans le menu et sur l’intégralité de votre site. Cela comprends aussi les moteurs de recherche.
          </div>
        </label>
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Slogan</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="slogan" type="text" class="w-80" value="<?= $settings->getSetting('slogan') ?>" required></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le slogan sera visble dans le footer. En quelques mots, décrivez la raison d’être de ce site.</div>
        </label>
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray pr-2">Description du site</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <textarea name="description" class="w-80 h-10 px-3" rows="10" cols="80" required><?= $settings->getSetting('description') ?></textarea>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette description pourra être visible par les moteurs de recherche. Faîtes une description concise.</div>
        </label>
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Logo du site</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <div class="w-80 button button-secondary">
              <span id="text">Changer le logo</span>
              <input name="logo" type="file" class="hidden file" accept="image/*" />
            </div>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le logo sera visible dans le menu et sur l’intégralité de votre site. Cela comprends aussi les moteurs de recherche.</div>
        </label>
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Favicon</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <div class="w-80 button button-secondary">
              <span id="text">Changer le favicon</span>
              <input name="favicon" type="file" class="hidden file" accept="image/*" />
            </div>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le favicon sera visible dans les onglets de votre navigateur.</div>
        </label>
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Image de fond</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <div class="w-80 button button-secondary">
              <span id="text">Changer l'image de fond</span>
              <input name="background" type="file" class="hidden file" accept="image/*" />
            </div>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">L'image de fond correspond à l'image de fond de la page de connexion / inscription.</div>
        </label>
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-4-sm col-4-xs color-gray">Autoriser les avis sur les produits</div>
          <div class="col-6-xl col-6-lg col-6-md col-6-sm col-6-xs">
            <label class="switch ml-5">
              <input name="allow_reviews" type="checkbox" <?= $settings->getSetting('allow_reviews') == 1 ? 'checked' : '' ?>>
              <span class="slider round"></span>
            </label>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette option est conseillée pour booster vos ventes ! Les avis sont un moyen efficace pour vos clients de se faire une opinion rapide.</div>
        </label>
        <label class="button-icon mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-4-sm col-4-xs color-gray">Visibilité sur les moteurs de recherche</div>
          <div class="col-6-xl col-6-lg col-6-md col-6-sm col-6-xs">
            <label class="switch ml-5">
              <input name="visibility_search_engine" type="checkbox" <?= $settings->getSetting('visibility_search_engine') == 1 ? 'checked' : '' ?>>
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
            <input name="stripe_public_key" class="w-80" placeholder="pk_test_..." value="<?= $settings->getSetting('stripe_public_key') ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette clé publique Stripe est utilisée pour l'envoi de paiements.</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Clé privée Stripe</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="stripe_private_key" class="w-80" placeholder="sk_test_..." value="<?= $settings->getSetting('stripe_private_key') ? "********************" : '' ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette clé privée Stripe ne doit pas être communiquée à personne.</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Devise par défaut</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <select name="currency" class="w-80">
              <option value="EUR" <?= $settings->getSetting('currency') == 'EUR' ? 'selected' : '' ?>>Euros</option>
              <option value="USD" <?= $settings->getSetting('currency') == 'USD' ? 'selected' : '' ?>>Dollars</option>
              <option value="GBP" <?= $settings->getSetting('currency') == 'GBP' ? 'selected' : '' ?>>Livres</option>
              <option value="CHF" <?= $settings->getSetting('currency') == 'CHF' ? 'selected' : '' ?>>Francs Suisse</option>
              <option value="CAD" <?= $settings->getSetting('currency') == 'CAD' ? 'selected' : '' ?>>Dollars Canadiens</option>
              <option value="AUD" <?= $settings->getSetting('currency') == 'AUD' ? 'selected' : '' ?>>Dollars Australiens</option>
              <option value="NZD" <?= $settings->getSetting('currency') == 'NZD' ? 'selected' : '' ?>>Dollars Nez-Zélandais</option>
              <option value="JPY" <?= $settings->getSetting('currency') == 'JPY' ? 'selected' : '' ?>>Yens</option>
              <option value="PLN" <?= $settings->getSetting('currency') == 'PLN' ? 'selected' : '' ?>>Zlotych</option>
              <option value="HUF" <?= $settings->getSetting('currency') == 'HUF' ? 'selected' : '' ?>>Forint</option>
              <option value="CZK" <?= $settings->getSetting('currency') == 'CZK' ? 'selected' : '' ?>>Koruna</option>
            </select>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette devise sera utilisée pour les paiements.</div>
        </label>
        <hr class="mt-16 mr-4 ml-4">
        <h3 class="color-gray pl-4 pt-8">Pour l'envoi de mails, vous devez configurer les informations de votre prestataire SMTP.</h3>
        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Adresse email SMTP</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="smtp_email" class="w-80" placeholder="admin@cms.fr" value="<?= $settings->getSetting('smtp_email') ?>" required></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette adresse email sera utilisée pour l'envoi de mails.</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">URL du serveur SMTP</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="smtp_url" class="w-80" placeholder="smtp.example.com" value="<?= $settings->getSetting('smtp_url') ?>" required></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">L'adresse du serveur SMTP.</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Port SMTP</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="smtp_port" class="w-80" placeholder="587" value="<?= $settings->getSetting('smtp_port') ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le port du serveur SMTP.</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Nom d'utilisateur SMTP</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="smtp_username" class="w-80" placeholder="username" value="<?= $settings->getSetting('smtp_username') ?>" required></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le nom d'utilisateur du serveur SMTP.</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Mot de passe SMTP</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="smtp_password" class="w-80" placeholder="password" value="<?= $settings->getSetting('smtp_password') ?>" required></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le mot de passe du serveur SMTP.</div>
        </label>

        <hr class="mt-12 mr-4 ml-4">
      </div>

      <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs pl-4 pr-4 pb-4">
        <h1>Liens et conditions</h1>
        <h3 class="color-gray pl-4">Vous pouvez ajouter des liens et des conditions dans votre boutique.</h3>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-2-sm col-2-xs" style="color: #1DA1F2;">
            <div class="row"><svg style="width: 24px; height:24px;" class="mr-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
              </svg> <span class="font-600">Twitter</span></div>
          </div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="twitter_link" class="w-80" placeholder="https://twitter.com/..." value="<?= $settings->getSetting('twitter_link') ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le lien vers votre compte Twitter</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-2-sm col-2-xs" style="color: #4267B2;">
            <div class="row"><svg style="width: 24px; height:24px;" class="mr-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
              </svg> <span class="font-600">Facebook</span></div>
          </div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="facebook_link" class="w-80" placeholder="https://facebook.com/..." value="<?= $settings->getSetting('facebook_link') ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le lien vers votre compte Facebook</div>
        </label>

        <label class="button-icon pl-4 mb-4 mt-8">
          <div class="col-2-xl col-2-lg col-2-md col-2-sm col-2-xs" style="color: #C13584;">
            <div class="row"><svg style="width: 24px; height:24px;" class="mr-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
              </svg> <span class="font-600">Instagram</span></div>
          </div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="instagram_link" class="w-80" placeholder="https://instagram.com/..." value="<?= $settings->getSetting('instagram_link') ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le lien vers votre compte Instagram</div>
        </label>

        <hr class="mt-8 mb-4 ml-4 mr-4">

        <label class="button-icon pl-4 mt-12 mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray font-600">Conditions générales</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="link_terms" type="text" class="w-80" placeholder="https://..." value="<?= $settings->getSetting('link_terms') ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Les conditions générales seront affichées sur la page de paiement et d'inscription</div>
        </label>

        <label class="button-icon pl-4 mt-12 mb-8">
          <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray font-600">Confidentialité</div>
          <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
            <input name="link_privacy" type="text" class="w-80" placeholder="https://..." value="<?= $settings->getSetting('link_privacy') ?>"></input>
          </div>
          <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">La politique de confidentialité sera affichée sur la page d'inscription</div>
        </label>

        <input type="submit" class="button button-primary w-100 h-10 mt-8 mb-8" value="Enregister tous les paramètres"></input>
      </div>
    </div>
  </div>
</form>