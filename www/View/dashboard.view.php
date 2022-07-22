<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Bonne soirée, <span class="color-primary"><?= $user->getFirstname() ?></span> 🙌</h1>
  <div class="row px-2">

    <div class="card card-<?php if ($user->getRole() === "admin") : echo "3";
                          else : echo "2";
                          endif; ?> card-warning card-shadow col-3-xl col-12-md mx-auto">
      <h2 class="icon">Commandes
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
        </svg>
      </h2>
      <h3 class="font-600 color-gray">Nombre de commandes</h3>
      <h1 class="text-right">
        <?php if ($user->getRole() === "admin") {
          echo count($orders->findAll());
        } else {
          echo count($orders->findAllBy('user_id', $user->getId(), OrderModel::class));
        } ?></h1>
    </div>
    <?php if ($user->getRole() === "admin") : ?>
      <div class="card card-3 card-success card-shadow col-3-xl col-12-md mx-auto">
        <h2 class="icon">Produits
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd" />
          </svg>
        </h2>
        <h3 class="font-600 color-gray">Nombre de produits</h3>
        <h1 class="text-right"><?= count($products->findAll()) ?></h1>
      </div>
      '<div class="card card-3 card-primary card-shadow col-3-xl col-12-md mx-auto">
        <h2 class="icon">Utilisateurs
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
          </svg>
        </h2>
        <h3 class="font-600 color-gray">Nombre d'utilisateurs</h3>
        <h1 class="text-right"><?= count($users->findAll()) ?></h1>
      </div>
    <?php else : ?>
      <div class="card card-2 card-primary card-shadow col-3-xl col-12-md mx-auto">
        <h2 class="icon">Exp. d'acheteur
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
          </svg>
        </h2>
        <h3 class="font-600 color-gray">Niveau actuel</h3>
        <h1 class="text-right">1</h1>
      </div>
    <?php endif; ?>
    <div class="card col-3-xl mx-auto w-95">
      <h2 class="color-primary icon">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 36px; height:36px;" class="hidden-under-md mr-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
        </svg>
        Commandes récentes
      </h2>
      <table class="mt-5" id="table-orders">
        <thead>
          <tr>
            <th scope="col">
              <div class="text-center">
                Date de la commande
              </div>
            </th>
            <th scope="col">
              <div class="text-center">
                ID
              </div>
            </th>
            <th scope="col">
              <div class="text-center">
                Adresse
              </div>
            </th>
            <th scope="col">
              <div class="text-center">
                Prix total
              </div>
            </th>
            <th scope="col">
              <div class="text-center">
                Status
              </div>
            </th>
            <th scope="col">
              <div class="text-center">
                Action
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $findOrders = $orders->findAllBy('user_id', $user->getId(), OrderModel::class);
          if ($user->getRole() === "admin") {
            $findOrders = $orders->findAll();
          }
          if (empty($findOrders)) : ?>
            <h2 class="pl-8 pt-5">Il n'y a rien à voir ici <span class="color-primary"><?= $user->getFirstname() ?></span>, aucune commande n'a été effectuée 📦</h2>
          <?php endif;
          foreach ($findOrders as $order) : ?>

            <tr>
              <td data-label="Date"><?= $order->captured_at ?></td>
              <td data-label="ID"><?= $order->id ?></td>
              <td data-label="Adresse"><?= $order->name . ' ' . $order->lastname . ' ' . $order->address . ' ' . $order->postal_code . ' ' . $order->city . ' ' . $order->country ?> </td>
              <td data-label="Prix Total"><?= $order->amount . ' ' . $order->currency ?></td>
              <td data-label="Status">
                <div class="status status-success"><?= $order->payment_status ?></div>
              </td>
              <td data-label="Action">
                <div class="action">
                  <button class="button-icon">
                    Consulter
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg></button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>