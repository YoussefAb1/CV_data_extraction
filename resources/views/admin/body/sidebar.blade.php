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
        <li class="nav-item nav-category">Principal</li>
        <li class="nav-item">
          <a href="{{route('admin.dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">Copropriété</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#residence" role="button" aria-expanded="false" aria-controls="residence">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Gestion Résidence </span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="residence">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{ route('all.residence') }}" class="nav-link">Lister Résidences</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add.residence') }}" class="nav-link">Ajouter Résidence</a>
              </li>

            </ul>
          </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#immeuble" role="button" aria-expanded="false" aria-controls="immeuble">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Gestion Immeuble </span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="immeuble">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('all.immeuble') }}" class="nav-link">Lister Immeubles</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.immeuble') }}" class="nav-link">Ajouter Immeuble</a>
                </li>

              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#appartement" role="button" aria-expanded="false" aria-controls="appartement">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Gestion Appartement </span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="appartement">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('all.appartement') }}" class="nav-link">Lister Appartements</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('add.appartement') }}" class="nav-link">Ajouter Immeuble</a>
                </li>

              </ul>
            </div>
          </li>


        <li class="nav-item nav-category">Components</li>
        <li class="nav-item">
                <a href="pages/apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                </a>
                </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="feather"></i>
            <span class="link-title">UI Kit</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="uiComponents">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
              </li>
              <li class="nav-item">
                <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
              </li>

            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Advanced UI</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="advancedUI">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
              </li>
              <li class="nav-item">
                <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
              </li>

            </ul>

        </li>





        <li class="nav-item nav-category">Docs</li>
        <li class="nav-item">
          <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="link-title">Documentation</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <nav class="settings-sidebar">
    <div class="sidebar-body">
      <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
      </a>
      <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Theme:</h6>
        <a class="theme-item" href="../demo1/dashboard.html">
          <img src="../assets/images/screenshots/light.jpg" alt="light theme">
        </a>
        <h6 class="text-muted mb-2">Dark Theme:</h6>
        <a class="theme-item active" href="../demo2/dashboard.html">
          <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
        </a>
      </div>
    </div>
  </nav>
