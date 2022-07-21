<div class="col-3-xl col-3-lg col-3-md col-3-sm col-3-xs hidden-under-xl bg-white column container-menu" id="back-menu" style="min-height:100vh">
  <div class="pt-10 pl-8">
    <div class="row align-flex-center inline-block">
      <a href="/profile" class="row align-flex-center inline-block">
        <img class="avatar mr-5" src="<?= $user->getAvatar() ?>" alt="avatar">
        <div class="column">
          <h2><?= $user->getFirstname(), ' ', $user->getLastname() ?></h2>
          <h3 class="pt-1 font-600 color-gray"><?= $user->getFormattedRole() ?></h3>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px; height:25px;" class="ml-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    </a>
  </div>
  <div class="pt-8 pl-8 button-icon">
    <img class="mini-logo mx-6" src="/assets/images/<?= $settings->getSetting('logo') ?? 'logo.png' ?>" alt="logo">
    <h3><?= $settings->getSetting('title') ?? 'CMS' ?></h3>
  </div>
  <div class="pl-8 pt-3">
    <a id="dashboard-button" class="button button-secondary--menu button-icon w-85" href="/dashboard">
      <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>
      Tableau de bord</a>
    <a id="orders-button" class="button button-secondary--menu button-icon w-85" href="/admin/orders">
      <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
      Commandes</a>
    <?php
    if ($user->getRole() == 'admin') : ?>
      <a id="products-button" class="button button-secondary--menu button-icon w-85" href="/admin/products">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
        Produits</a>
      <a id="users-button" class="button button-secondary--menu button-icon w-85" href="/admin/users">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        Utilisateurs</a>
      <a id="reviews-button" class="button button-secondary--menu button-icon w-85" href="/admin/reviews">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        Commentaires</a>
      <button class="button button-secondary--menu button-icon w-85 mb-5" onclick="showMenu()">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        Réglages
        <svg id="arrow" xmlns="http://www.w3.org/2000/svg" style="width: 20px; height:20px;" class="ml-auto mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" transform="rotate(-90)">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
    <?php endif; ?>
    <div id="hidden-menu" style="display: none;">
      <a id="shop-button" class="button button-secondary--menu button-icon w-70 ml-5" href="/admin/settings">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Boutique</a>
      <a id="pages-button" class="button button-secondary--menu button-icon w-70 ml-5" href="/admin/pages">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
        </svg>
        Pages</a>
      <a id="menus-button" class="button button-secondary--menu button-icon w-70 ml-5 mb-5" href="/admin/menus">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
        </svg>
        Menus</a>

    </div>
  </div>
</div>

<script>
  function showMenu() {
    var div = document.getElementById("hidden-menu");
    var arrow = document.getElementById("arrow");
    if (div.style.display === "none") {
      arrow.setAttribute("transform", "rotate(0)");
      div.style.display = "block";
    } else {
      div.style.display = "none";
      arrow.setAttribute("transform", "rotate(-90)");
    }
  }

  function highlightButton() {
    switch (location.pathname.substr(1)) {
      case "dashboard":
        document.getElementById("dashboard-button").setAttribute("style", "background-color: #eeeeee;");
        break;
      case "admin/orders":
        document.getElementById("orders-button").setAttribute("style", "background-color: #eeeeee;");
        break;
      case "admin/products":
        document.getElementById("products-button").setAttribute("style", "background-color: #eeeeee;");
        break;
      case "admin/users":
        document.getElementById("users-button").setAttribute("style", "background-color: #eeeeee;");
        break;
      case "admin/settings":
        showMenu();
        document.getElementById("shop-button").setAttribute("style", "background-color: #eeeeee;");
        break;
      case "admin/pages":
        showMenu();
        document.getElementById("pages-button").setAttribute("style", "background-color: #eeeeee;");
        break;
      case "admin/menus":
        showMenu();
        document.getElementById("menus-button").setAttribute("style", "background-color: #eeeeee;");
        break;
      case "admin/reviews":
        document.getElementById("reviews-button").setAttribute("style", "background-color: #eeeeee;");
        break;

    }
  }
</script>