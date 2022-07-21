<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8">Tous les utilisateurs 👤</h1>
</div>
<div class="table mx-auto">
  <table class="mt-5" id="table-user">
    <thead>
      <tr>
        <th scope="col">
          <div class="text-center">
            ID
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Prénom
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Nom
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Email
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Status
          </div>
        </th>
        <th scope="col">
          <div class="text-center">
            Rôle
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
      <?php foreach ($users->findAll() as $user) : ?>
        <tr>
          <td class="wrap-long" data-label="ID"><?= $user->id ?></td>
          <td class="wrap-long" data-label="Prénom"><?= $user->firstname ?></td>
          <td class="wrap-long" data-label="Nom"><?= $user->lastname ?></td>
          <td class="wrap-long" data-label="Email"><?= $user->email ?></td>
          <td data-label="Status">
            <div class="status status<?= $user->status == "1" ? "-success" : "" ?>"><?= $user->status == "1" ? "Vérifié" : "Non vérifié" ?></div>
          </td>
          <td data-label="Rôle">
            <div class="status status-<?= $user->role == "admin" ? "error" : "primary" ?>"><?= $user->role == "admin" ? "Admin" : "Utilisateur" ?></div>
          </td>
          <td data-label="Action">
            <div class="action">
              <a class="button-icon" href="/admin/users/edit/<?= $user->id ?>">
                Consulter
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg></a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#table-user').DataTable();
  });
</script>