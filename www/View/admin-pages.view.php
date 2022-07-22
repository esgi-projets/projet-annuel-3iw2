<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Toutes les pages 📑</h1>
  <div class="row mt-2 pr-3 pl-3 pb-5">
    <a class="ml-3 button button-tertiary" href='/admin/pages/create'>Créer une page</a>
  </div>
  <div class="ml-5">
    <?php
    if (empty($pages->findAll())) : ?>
      <h2 class="pl-8">Il n'y a rien à voir ici <span class="color-primary"><?= $user->getFirstname() ?></span>, vous n'avez pas encore créé de page ! 🚧</h2>
    <?php else : ?>
      <?php foreach ($pages->findAll() as $page) :
      ?>
        <div class="card card-3 card-primary card-shadow col-3-xl col-12-md mx-3">
          <h2 class="icon"><?= $page->title ?>
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd" />
            </svg>
          </h2>

          <div class="action mt-5 ml-3">
            <a class="button-icon" href='/admin/pages/edit/<?= $page->id ?>'>
              Consulter
              <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
              </svg></a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>