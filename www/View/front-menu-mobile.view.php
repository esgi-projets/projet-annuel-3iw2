<div class="sidebar" id="mySidebar">
  <div class="blocker"></div>
  <div class="content bg-white">
    <button class="button button-link button-icon mt-4 mr-4 ml-auto" id="closeMenu"><svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    <div class="bg-white column container-menu" id="front-menu" style="min-height:100vh">
      <div class="pt-8 pl-8 button-icon">
        <img class="mini-logo mx-6" src="/assets/images/<?= $settings->getSetting('logo') ?? 'logo.png' ?>" alt="logo">
        <h3><?= $settings->getSetting('title') ?? 'CMS' ?></h3>
      </div>
      <div class="pl-8 pt-3">
        <a id="home-button" class="button button-secondary--menu button-icon w-85" href="/">
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Accueil</a>
        <a id="products-button" class="button button-secondary--menu button-icon w-85" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" class="mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          Produits</a>
      </div>
    </div>
  </div>
</div>



<script>
  const sidebar = document.querySelector('.sidebar');
  sidebar.querySelector('.blocker').onclick = hide;

  var open = document.getElementById("openMenu");
  var close = document.getElementById("closeMenu");
  var show_back_menu = document.getElementById("front-menu");

  open.onclick = show;
  close.onclick = hide;

  function show() { // click open
    sidebar.classList.add('visible');
    document.body.style.overflow = 'hidden';
  }

  function hide() { // by blocker click, click close
    sidebar.classList.remove('visible');
    document.body.style.overflow = '';
  }

  function toggle() {
    sidebar.classList.contains('visible') ? hide() : show();
  }
</script>