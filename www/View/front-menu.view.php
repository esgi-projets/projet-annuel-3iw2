<div class="hidden-under-md">
  <nav class="nav nav-border">
    <ul class="menu">
      <div class="menu-left">
        <img class="mini-logo mx-6" src="./assets/images/<?= $settings->getSetting('logo') ?? 'logo.png' ?>" alt="logo">
        <div class="links">
          <li><a href="/">Accueil</a></li>
          <li><a href="/products">Produits</a></li>
        </div>
      </div>
      <div class="menu-right">
        <a href="/login" class="account">Mon compte</a>
        <div class="row">
          <a href="/cart"><svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </a>
          <span class='badge bg-success-pastel color-success' id='cart-count'>0</span>
        </div>
      </div>
    </ul>
  </nav>
</div>

<div class="hidden-xl hidden-lg">
  <nav class="nav nav-border">
    <ul class="menu">
      <div class="menu-left">
        <img class="mini-logo mx-6" src="/assets/images/<?= $settings->getSetting('logo') ?? 'logo.png' ?>" alt="logo">
      </div>
      <div class="menu-right">
        <button class="button button-link button-icon" id="openMenu"><svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </ul>
  </nav>
</div>