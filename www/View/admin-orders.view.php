<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Toutes les commandes 📦</h1>
</div>
<div class="table col-12-xl mx-auto">
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
        <th scope="col">
          <div class="text-center">
            Action
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
      <tr>
        <td data-label="Date">10/02/2022</td>
        <td data-label="ID">4</td>
        <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
        <td data-label="Produits">Échappement, huile, ....</td>
        <td data-label="Prix Totaux">607.12€</td>
        <td data-label="Status">
          <div class="status status-success">Payée</div>
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
      <tr>
        <td data-label="Date">10/02/2022</td>
        <td data-label="ID">3</td>
        <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
        <td data-label="Produits">Moteur, porte clé, ...</td>
        <td data-label="Prix Totaux">10200.33€</td>
        <td data-label="Status">
          <div class="status">En attente</div>
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
      <tr>
        <td data-label="Date">09/02/2022</td>
        <td data-label="ID">2</td>
        <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
        <td data-label="Produits">Porte, remplacement clé, .</td>
        <td data-label="Prix Totaux">400.33€</td>
        <td data-label="Status">
          <div class="status status-error">Échouée</div>
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
      <tr>
        <td data-label="Date">07/02/2022</td>
        <td data-label="ID">1</td>
        <td data-label="Utilisateur"><?= $user->getFirstname() ?></td>
        <td data-label="Produits">Porte</td>
        <td data-label="Prix Totaux">200.33€</td>
        <td data-label="Status">
          <div class="status status-warning">En cours</div>
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
    </tbody>
  </table>
</div>