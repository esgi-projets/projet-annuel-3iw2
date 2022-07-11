<div class="sidenav" id="mySidenav">
  <button class="button button-link button-icon" id="closeBtn"><svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>
  <?php
  include 'back-menu.view.php';
  ?>
</div>

<div class="hidden-xl">
  <button class="button button-link button-icon" id="openBtn"><svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>
</div>
<div class="row hidden-under-md ml-auto mr-3">
  <a href="/" class="button button-link button-icon">
    <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
    </svg>
    Visiter ma boutique</a>
  <a href="/logout" class="button button-secondary">Se déconnecter</a>
</div>


<script>
  var sidenav = document.getElementById("mySidenav");
  var openBtn = document.getElementById("openBtn");
  var closeBtn = document.getElementById("closeBtn");
  var show_back_menu = document.getElementById("back-menu");

  openBtn.onclick = openNav;
  closeBtn.onclick = closeNav;

  /* Set the width of the side navigation to 250px */
  function openNav() {
    //sidenav.classList.add("active");
    show_back_menu.classList.remove("hidden-under-xl");
  }

  /* Set the width of the side navigation to 0 */
  function closeNav() {
    //sidenav.classList.remove("active");
    show_back_menu.classList.add("hidden-under-xl");
  }
</script>