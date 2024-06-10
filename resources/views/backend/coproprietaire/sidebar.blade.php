<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Digi<span>Syndic</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('coproprietaire.dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">Copropriété</li>


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charge" role="button" aria-expanded="false" aria-controls="charge">
                <i class="link-icon" data-feather="dollar-sign"></i>
                <span class="link-title">Gestion Charges </span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="charge">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('coproprietaire.all.charge') }}" class="nav-link">Lister Charges</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.charge') }}" class="nav-link">Ajouter Charge</a>
                </li>

              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cotisation" role="button" aria-expanded="false" aria-controls="cotisation">
                <i class="link-icon" data-feather="dollar-sign"></i>
                <span class="link-title">Gestion Cotisations </span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="cotisation">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('coproprietaire.all.cotisation') }}" class="nav-link">Lister Cotisations</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.cotisation') }}" class="nav-link">Ajouter Cotisation</a>
                </li>

              </ul>
            </div>
          </li>



        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#paiement" role="button" aria-expanded="false" aria-controls="paiement">
                <i class="link-icon" data-feather="credit-card"></i>
                <span class="link-title">Gestion Paiements </span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="paiement">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('coproprietaire.all.paiement') }}" class="nav-link">Lister Paiements</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.paiement') }}" class="nav-link">Ajouter Paiement</a>
                </li>

              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#facture" role="button" aria-expanded="false" aria-controls="facture">
                <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">Gestion Factures </span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="facture">
              <ul class="nav sub-menu">

                <li class="nav-item">
                  <a href="{{ route('coproprietaire.all.facture') }}" class="nav-link">Lister Factures</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.facture') }}" class="nav-link">Ajouter Facture</a>
                </li>

              </ul>
            </div>
          </li>


      </ul>
    </div>
  </nav>
  <nav class="settings-sidebar">
    <div class="sidebar-body">
      <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
      </a>
      <h6 class="text-muted">Sidebar:</h6>
      <div class="form-group border-bottom">
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
            Light
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
            Dark
          </label>
        </div>
      </div>
      <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Theme:</h6>
        <a class="theme-item active" href="demo_1/dashboard-one.html">
          <img src="assets/images/screenshots/light.jpg" alt="light theme">
        </a>
        <h6 class="text-muted mb-2">Dark Theme:</h6>
        <a class="theme-item" href="demo_2/dashboard-one.html">
          <img src="assets/images/screenshots/dark.jpg" alt="light theme">
        </a>
      </div>
    </div>
  </nav>
