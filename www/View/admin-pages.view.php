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
        <h1 class="pl-8">Un peu de patience <span class="color-primary"><?= $user->getFirstname() ?></span>, nous travaillons sur cette page 🚧</h1>
        <div class="row hidden-under-md mt-2 pr-3 pl-3 pb-5">
          <a class="ml-3 button button-tertiary" href='/admin/pages/create'>Créer une page</a>
        </div>
        <?php foreach ($pages->findAll() as $page) : ?>
          <div class="column mt-2 pr-3 pl-3 pb-5">
            <a class="ml-3 button button-link action" href='/admin/pages/edit/<?= $page->id ?>'><?= $page->title ?> <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
              </svg></a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</div>