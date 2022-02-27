<div class="row">
  <div class="height-screen col-3-xl hidden-xl bg-lightgrey column container-menu">
    <div class="wrapper">
      <div class="inner">
        <h2 class="pt-10"><img class="avatar mr-5" src="./assets/images/cat.jpg" alt="avatar"><?= $firstname ?> <?= $lastname ?><h3 class="pl-21">Administrateur</h3>
        </h2>
      </div>
    </div>
    <button class="button button--secondary--menu">Tableau de bord</button>
    <button class="button button--secondary--menu">Commandes</button>
    <button class="button button--secondary--menu">Produits</button>
    <button class="button button--secondary--menu">Utilisateurs</button>
    <button class="button button--secondary--menu">Reglages</button>

  </div>
  <div class="col-9-xl col-12-lg col-12-md col-12-sm col-12-xs">
    <div class="row">
      <div class="hidden-md ml-auto mr-0">
        <button class="button button--link">Visiter ma boutique</button>
        <button class="button button--secondary">Se déconnecter</button>
      </div>
      <div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
        <h1 class="ml-10">Bonne soirée, <span class="color-primary"><?= $firstname ?></span></h1>
        <div class="row">
          <div class="card card-3 card--primary col-3-xl mx-auto text-center">
            <h2>Commandes</h2>
            <h3>Nombre de commandes</h3>
            <h1>12</h1>
          </div>
          <div class="card card-3 card--warning col-3-xl mx-auto text-center">
            <h2>Produits</h2>
            <h3>Nombre de produits</h3>
            <h1>8</h1>
          </div>
          <div class="card card-3 card--error col-3-xl mx-auto text-center">
            <h2>Utilisateurs</h2>
            <h3>Nombre d'utilisateurs</h3>
            <h1>1202</h1>
          </div>
          <div class="card card--lightgrey col-3-xl mx-auto">
            <h2 class="color-primary">Commandes récentes</h2>
            <table class="mt-5">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">ID</th>
                  <th scope="col">Utilisateur</th>
                  <th scope="col">Produits</th>
                  <th scope="col">Prix Totaux</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td data-label="Date">13/02/2022</td>
                  <td data-label="ID">5</td>
                  <td data-label="Utilisateur"><?= $firstname ?></td>
                  <td data-label="Produits">Courroie, freins, ...</td>
                  <td data-label="Prix Totaux">1200.33€</td>
                  <td data-label="Status">Payée</td>
                </tr>
                <tr>
                  <td data-label="Date">10/02/2022</td>
                  <td data-label="ID">4</td>
                  <td data-label="Utilisateur"><?= $firstname ?></td>
                  <td data-label="Produits">Échappement, huile, ....</td>
                  <td data-label="Prix Totaux">607.12€</td>
                  <td data-label="Status">Payée</td>
                </tr>
                <tr>
                  <td data-label="Date">10/02/2022</td>
                  <td data-label="ID">3</td>
                  <td data-label="Utilisateur"><?= $firstname ?></td>
                  <td data-label="Produits">Moteur, porte clé, ...</td>
                  <td data-label="Prix Totaux">10200.33€</td>
                  <td data-label="Status">En attente</td>
                </tr>
                <tr>
                  <td data-label="Date">09/02/2022</td>
                  <td data-label="ID">2</td>
                  <td data-label="Utilisateur"><?= $firstname ?></td>
                  <td data-label="Produits">Porte, remplacement clé, .</td>
                  <td data-label="Prix Totaux">400.33€</td>
                  <td data-label="Status">Echouée</td>
                </tr>
                <tr>
                  <td data-label="Date">07/02/2022</td>
                  <td data-label="ID">1</td>
                  <td data-label="Utilisateur"><?= $firstname ?></td>
                  <td data-label="Produits">Porte</td>
                  <td data-label="Prix Totaux">200.33€</td>
                  <td data-label="Status">En cours</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>