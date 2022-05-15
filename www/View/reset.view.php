<h1>Mot de passe oublié ?</h1>

<?php if (!isset($token)) : ?>
  <h3 class="ml-4 mb-4">Aucun problème. Renseignez votre adresse e-mail et nous vous enverrons un lien de réinitialisation de votre mot de passe.</h3>
  <?php
  $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
  $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
  $this->includePartial("form", $user->getFormReset());
  ?>
<?php else : ?>
  <h3 class="ml-4 mb-4">Vous êtes sur le point de réinitialiser votre mot de passe. Veuillez entrer votre nouveau mot de passe.</h3>
  <?php
  $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
  $this->includePartial("form", $user->getFormResetPassword($token));
  ?>
<?php endif; ?>