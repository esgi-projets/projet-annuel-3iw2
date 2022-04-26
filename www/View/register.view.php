<h1>S'inscrire</h1>

<?php $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]) ?>
<?php $this->includePartial("form", $user->getFormRegister()) ?>