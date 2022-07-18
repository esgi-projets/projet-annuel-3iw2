<div class="row" style="min-height:100vh;">
  <div class="col-6-xl col-12-xs">
    <a class="button button-link button-icon" href="javascript:history.back()"> <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
      </svg>
      </svg> Retour
    </a>
    <div class="container-center">
      <div class="w-80 mt-4">
        <img class="logo mx-6" src="./assets/images/BMW_logo_(gray).svg.png" alt="logo">
        <h1 class="ml-4">Se connecter</h1>
        <h3 class="mb-8 ml-8">Pour accéder à cette page il est nécessaire de s’authentifier</h3>

        <div class="pl-5">
          <div class="pr-2 pl-2">
            <?php
            $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
            $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
            ?>
          </div>
          <?php $this->includePartial("form", $user->getFormLogin()) ?>
          <div class="column mt-2 pr-3 pl-3 pb-5">
            <a class="button button-secondary mt-5" href="register">Créer un compte</a>
            <a class="button button-link mt-5" href="reset">Mot de passe oublié ?</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6-xl hidden-under-xl">
    <img class="fit-image" src="./assets/images/dmitry-timofeew-UU18rjWiQmo-unsplash.jpg" alt="side-image">
  </div>
</div>