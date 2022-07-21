<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="font-600 color-dark">Étape <span class="color-primary">1/3</span> - Base de données</h1>
  <h2 class="font-600 color-gray mt-4 ml-4">Vous devez avoir accès à une <span class="color-primary">base de données</span> pour pouvoir installer ce site. Ce site est compatible avec <span class="color-primary">MySQL</span>.</h2>

  <form action="" method="POST">
    <div class="mr-6 ml-6">
      <?php
      $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
      $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
      ?>
    </div>

    <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs pl-4 pr-4 mt-10 px-6">
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Adresse IP ou domaine</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="dbhost" type="text" class="w-80" required placeholder="localhost">
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Cette URL est utilisée pour se connecter à votre base de données.</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Port</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="dbport" type="text" class="w-80" required placeholder="3306">
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Ce port peut différer selon votre hébergeur.</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Nom d'utilisateur</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="dbuser" type="text" class="w-80" required placeholder="root">
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Ce nom d'utilisateur est utilisé pour se connecter à votre base de données.</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Mot de passe</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="dbpass" type="password" class="w-80" required placeholder="root">
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Ce mot de passe est utilisé pour se connecter à votre base de données.</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Nom de la base de données</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="dbname" type="text" class="w-80" required placeholder="database">
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Ce nom de la base de données est utilisé pour stocker les données de votre site.</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Préfixe des tables</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="dbprefix" type="text" class="w-80" required placeholder="cms_">
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Ce préfixe est utilisé pour nommer les tables de votre site.</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Moteur de base de données</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <select name="dbengine" class="input-select">
            <option value="mysql">MySQL</option>
          </select>
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">À l'heure actuelle, seul MySQL est supporté.</div>
      </label>

      <input type="submit" class="button button-primary w-100 h-5 mt-8" value="Passer à l'étape suivante"></input>
    </div>
  </form>
</div>