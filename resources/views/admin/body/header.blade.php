<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="search"></i>

                    </div>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">


</li>

            <li class="nav-item dropdown nav-messages">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="mail"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="messageDropdown">



                </div>
            </li>
            
            @php

            $id = Auth::user()-> id;
            $dataProfile = App\Models\User::find($id);

                @endphp

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($dataProfile->photo)) ? url('upload/admin_images/'.$dataProfile->photo) : url('upload/no_image.jpg') }}" alt="profile">
                    </a>
                    <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                        <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                            <div class="mb-3">
                                <img class="wd-80 ht-80 rounded-circle" src="{{ (!empty($dataProfile->photo)) ? url('upload/admin_images/'.$dataProfile->photo) : url('upload/no_image.jpg') }}" alt="profile">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{$dataProfile->name}}</p>
                                <p class="tx-12 text-muted">{{$dataProfile->email}}</p>
                            </div>
                        </div>

                        <ul class="list-unstyled p-1">
                            <li class="dropdown-item py-2">
                              <a href="{{route('admin.profile')}}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profil</span>
                              </a>
                            </li>
                            <li class="dropdown-item py-2">
                              <a href="{{route('admin.change.password')}}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Modifier Mot de Passe</span>
                              </a>
                            </li>

                            <li class="dropdown-item py-2">
                              <a href="{{route('admin.logout')}}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Se Déconnecter</span>
            </a>
          </li>
        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
