<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <form enctype="multipart/form-data" action="" method="POST">
    <div class="mr-6 ml-6">
      <?php
      $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
      $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
      ?>
    </div>

    <h1 class="pl-8">Mon profil</h1>
    <h3 class="color-gray pl-8">Cette page permet de modifier votre profil et de changer votre mot de passe.</h3>
    <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs px-8 pt-2">
      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Votre prénom</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="title" type="text" class="w-80" value="<?= $user->getFirstname() ?>" required></input>
        </div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Votre nom</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="slogan" type="text" class="w-80" value="<?= $user->getLastname() ?>" required></input>
        </div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Votre email</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="description" type="text" class="w-80" value="<?= $user->getEmail() ?>" required></input>
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">En cas de changement de votre email, vous serez invité à le confirmer et à vous reconnecter.</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Votre mot de passe actuel</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="password" type="password" class="w-80"></input>
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Ce champ doit être rempli si vous souhaitez modifier votre mot de passe</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Nouveau mot de passe</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <input name="password_new" type="password" class="w-80"></input>
        </div>
        <div class=" col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le mot de passe doit contenir au moins 8 caractères dont au moins une majuscule, une minuscule et un chiffre</div>
      </label>

      <label class="button-icon mb-8">
        <div class="col-2-xl col-2-lg col-2-md col-6-sm col-6-xs color-gray">Avatar</div>
        <div class="col-6-xl col-6-lg col-6-md col-12-sm col-12-xs">
          <div class="w-80 button button-secondary">
            <span id="text">Changer mon avatar</span>
            <input name="logo" type="file" class="hidden file" accept="image/*" />
          </div>
        </div>
        <div class="col-4-xl col-4-lg col-4-md hidden-sm hidden-xs">Le format de l'image doit être .png, .jpg, .jpeg ou .gif</div>
      </label>

      <input type="submit" class="button button-primary w-100 h-10 mt-8 mb-8" value="Modifier mon profil"></input>

    </div>
  </form>
</div>