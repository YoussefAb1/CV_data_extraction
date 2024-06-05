<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Login | DigiSyndic</title>
        <!-- core:css -->
        <link rel="stylesheet" href="{{asset('backend/assets/vendors/core/core.css')}}">
        <!-- endinject -->
      <!-- plugin css for this page -->
        <!-- end plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('backend/assets/fonts/feather-font/css/iconfont.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
        <!-- endinject -->
      <!-- Layout styles -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/demo_2/style.css')}}">
      <!-- End layout styles -->
      <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.png')}}" />
    </head>
<style>

    .auth-left-wrapper{
        width: 100%;
        height: 100%;
        background-image: url({{asset('upload/login.png')}});
    }

    </style>


    <body>
        <div class="main-wrapper">
            <div class="page-wrapper full-page">
                <div class="page-content d-flex align-items-center justify-content-center">

                    <div class="row w-100 mx-0 auth-page">
                        <div class="col-md-8 col-xl-6 mx-auto">
                            <div class="card">
                                <div class="row">
                    <div class="col-md-4 pr-md-0">
                      <div class="auth-left-wrapper">


                      </div>
                    </div>
                    <div class="col-md-8 pl-md-0">
                      <div class="auth-form-wrapper px-4 py-5">
                        <a href="#" class="noble-ui-logo logo-light d-block mb-2">Digi<span>Syndic</span></a>
                        <h5 class="text-muted font-weight-normal mb-4">Bienvenue de retour ! Connectez-vous à votre compte.</h5>
                        <form class="forms-sample" method="post" action={{route('login')}}>
                            @csrf
                          <div class="form-group">
                            <label for="login" class="form-label">Email / Nom / Téléphone</label>
                            <input type="text" class="form-control" name="login" id="login" placeholder="Email / Nom / Téléphone">
                          </div>
                          <div class="form-group">
                            <label for="password" class="form-label">Mot de passe
                        </label>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" placeholder="Mot de passe
                        ">
                          <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                              Se souvenir de moi
                            </label>
                          </div>
                          <div>
                            <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                              Login
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- core:js -->
        <script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
        <!-- endinject -->
      <!-- plugin js for this page -->
        <!-- end plugin js for this page -->
        <!-- inject:js -->
        <script src="{{asset('backend/assets/vendors/feather-icons/feather.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/template.js')}}"></script>
        <!-- endinject -->
      <!-- custom js for this page -->
        <!-- end custom js for this page -->
    </body>
    </html>
