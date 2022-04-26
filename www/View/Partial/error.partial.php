<div class="w-100 h-10 mt-5 mb-5 px-5 bg-error-pastel border-radius-1 <?= $config['visible'] ? '' : 'hidden' ?>">
  <h3 class="font-700 color-error"><?= $config['message'] ?? 'Une erreur est survenue, merci de réessayer' ?></h3>

  <?php
  if (isset($config['list'])) {
    foreach ($config['list'] as $error) {
  ?>
      <h4 class="font-700 color-error mt-3">• <?= $error ?></h4>
  <?php
    }
  }
  ?>
</div>