<div class="row" style="min-height:100vh;">
  <div class="col-6-xl col-12-xs">
    <a class="button button-link button-icon" href="login"> <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
      </svg>
      </svg> Retour
    </a>
    <div class="container-center">
      <div class="w-80 mt-4">
        <img class="logo mx-6" src="./assets/images/BMW_logo_(gray).svg.png" alt="logo">
        <h1 class="ml-4">Mot de passe oublié ?</h1>

        <div class="pl-5">
          <?php if (!isset($token)) : ?>
            <h3 class="ml-3 mb-4">Aucun problème. Renseignez votre adresse e-mail et nous vous enverrons un lien de réinitialisation de votre mot de passe.</h3>
          <?php
            $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
            $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
            $this->includePartial("form", $user->getFormReset());
          else : ?>
            <h3 class="ml-4 mb-4">Vous êtes sur le point de réinitialiser votre mot de passe. Veuillez entrer votre nouveau mot de passe.</h3>
            <?php
            $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
            $this->includePartial("form", $user->getFormResetPassword($token));
            ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6-xl hidden-under-xl">
    <img class="fit-image" src="./assets/images/dmitry-timofeew-UU18rjWiQmo-unsplash.jpg" alt="side-image">
  </div>
</div>