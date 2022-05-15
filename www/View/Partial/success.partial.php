<div class="w-100 h-10 mt-5 mb-5 px-5 bg-success-pastel border-radius-1 <?= $config['visible'] ? '' : 'hidden' ?>">
  <h3 class="font-700 color-success"><?= $config['message'] ?? 'Votre progression a été sauvegardée' ?></h3>

  <?php
  if (isset($config['list'])) {
    foreach ($config['list'] as $message) {
  ?>
      <h4 class="font-700 color-success mt-3">• <?= $message ?></h4>
  <?php
    }
  }
  ?>
</div>