<div class="row">
  <?php
  include 'back-menu.view.php';
  ?>

  <div class="col-9-xl col-12-lg col-12-md col-12-sm col-12-xs">
    <div class="row">
      <?php
      include 'back-menu-mobile.view.php';
      ?>
      <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
        <h1 class="pl-8">Réglages généraux 🔐</h1>
        <div class="row" style="min-height:100vh;">
          <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs px-8 pt-2">
            <label class="button-icon mb-8">
              <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs">Titre du site</div>
              <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
                <input class="w-80"></input>
              </div>
              <div class="col-4-xl col-4-lg col-4-md hidden-sm">Le titre sera visible dans le menu et sur l’intégralité de votre site. Cela comprends aussi les moteurs de recherche.</div>
            </label>
            <label class="button-icon mb-8">
              <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs">Slogan</div>
              <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
                <input class="w-80"></input>
              </div>
              <div class="col-4-xl col-4-lg col-4-md hidden-sm">Le slogan sera visble dans le menu. En quelques mots, décrivez la raison d’être de ce site.</div>
            </label>
            <label class="button-icon mb-8">
              <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs">Description du site</div>
              <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
                <textarea class="w-80 h-10" rows="10" cols="80"></textarea>
              </div>
              <div class="col-4-xl col-4-lg col-4-md hidden-sm">Cette description pourra être visible par les moteurs de recherche. Faîtes une description concise.</div>
            </label>
            <label class="button-icon mb-8">
              <div class="col-2-xl col-2-lg col-2-md col-4-sm col-4-xs">Autoriser les avis sur les produits</div>
              <div class="col-6-xl col-6-lg col-6-md col-6-sm col-6-xs">
                <label class="switch ml-5">
                  <input type="checkbox">
                  <span class="slider round"></span>
                </label>
              </div>
              <div class="col-4-xl col-4-lg col-4-md hidden-sm">Cette option est conseillée pour booster vos ventes ! Les avis sont un moyen efficace pour vos clients de se faire une opinion rapide.</div>
            </label>
            <label class="button-icon mb-8">
              <div class="col-2-xl col-2-lg col-2-md col-4-sm col-4-xs">Maintenance</div>
              <div class="col-6-xl col-6-lg col-6-md col-6-sm col-6-xs">
                <label class="switch ml-5">
                  <input type="checkbox">
                  <span class="slider round"></span>
                </label>
              </div>
              <div class="col-4-xl col-4-lg col-4-md hidden-sm">Vous pouvez utiliser ce mode pour désactiver l’affichage du site aux utilisateurs non-administrateur.</div>
            </label>
            <label class="button-icon mb-8">
              <div class="col-2-xl col-2-lg col-2-md col-4-sm col-4-xs">Visibilité sur les moteurs de recherche</div>
              <div class="col-6-xl col-6-lg col-6-md col-6-sm col-6-xs">
                <label class="switch ml-5">
                  <input type="checkbox">
                  <span class="slider round"></span>
                </label>
              </div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>