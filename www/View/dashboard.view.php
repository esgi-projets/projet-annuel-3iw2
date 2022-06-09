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
        <h1 class="pl-8">Bonne soirée, <span class="color-primary"><?= $user->getFirstname() ?></span> 🙌</h1>
        <div class="row px-2">
          <div class="card card-3 card-warning card-shadow col-3-xl mx-auto">
            <h2 class="icon">Commandes
              <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
            </h2>
            <h3 class="font-600 color-gray">Nombre de commandes</h3>
            <h1 class="text-right">12</h1>
          </div>
          <div class="card card-3 card-success card-shadow col-3-xl mx-auto">
            <h2 class="icon">Produits
              <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd" />
              </svg>
            </h2>
            <h3 class="font-600 color-gray">Nombre de produits</h3>
            <h1 class="text-right">8</h1>
          </div>
          <div class="card card-3 card-primary card-shadow col-3-xl mx-auto">
            <h2 class="icon">Utilisateurs
              <svg xmlns="http://www.w3.org/2000/svg" style="width: 44px; height:44px;" class="ml-auto mr-3 hidden-under-md" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
              </svg>
            </h2>
            <h3 class="font-600 color-gray">Nombre d'utilisateurs</h3>
            <h1 class="text-right">1202</h1>
          </div>
          <div class="card col-3-xl mx-auto">
            <h2 class="color-primary icon">
              <svg xmlns="http://www.w3.org/2000/svg" style="width: 36px; height:36px;" class="hidden-under-md mr-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
              Commandes récentes
            </h2>
            <table class="mt-5">
              <thead>
                <tr>
                  <th scope="col">
                    <div class="text-center">
                      Date
                    </div>
                  </th>
                  <th scope="col">
                    <div class="text-center">
                      ID
                    </div>
                  </th>
                  <th scope="col">
                    <div class="text-center">
                      Utilisateur
                    </div>
                  </th>
                  <th scope="col">
                    <div class="text-center">
                      Produits
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
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td data-label="Date">13/02/2022</td>
                  <td data-label="ID">5</td>
                  <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
                  <td data-label="Produits">Courroie, freins, ...</td>
                  <td data-label="Prix Totaux">1200.33€</td>
                  <td data-label="Status">
                    <div class="status status-success">Payée</div>
                  </td>
                </tr>
                <tr>
                  <td data-label="Date">10/02/2022</td>
                  <td data-label="ID">4</td>
                  <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
                  <td data-label="Produits">Échappement, huile, ....</td>
                  <td data-label="Prix Totaux">607.12€</td>
                  <td data-label="Status">
                    <div class="status status-success">Payée</div>
                  </td>
                </tr>
                <tr>
                  <td data-label="Date">10/02/2022</td>
                  <td data-label="ID">3</td>
                  <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
                  <td data-label="Produits">Moteur, porte clé, ...</td>
                  <td data-label="Prix Totaux">10200.33€</td>
                  <td data-label="Status">
                    <div class="status">En attente</div>
                  </td>
                </tr>
                <tr>
                  <td data-label="Date">09/02/2022</td>
                  <td data-label="ID">2</td>
                  <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
                  <td data-label="Produits">Porte, remplacement clé, .</td>
                  <td data-label="Prix Totaux">400.33€</td>
                  <td data-label="Status">
                    <div class="status status-error">Échouée</div>
                  </td>
                </tr>
                <tr>
                  <td data-label="Date">07/02/2022</td>
                  <td data-label="ID">1</td>
                  <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
                  <td data-label="Produits">Porte</td>
                  <td data-label="Prix Totaux">200.33€</td>
                  <td data-label="Status">
                    <div class="status status-warning">En cours</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>