@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">


    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Bienvenue sur le Dashboard</h4>
      </div>
      <div class="d-flex align-items-center flex-wrap text-nowrap">
        <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
          <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
          <input type="text" class="form-control">
        </div>



      </div>
    </div>

    <div class="row">
      <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Nombre de Résidences</h6>
                  <div class="dropdown mb-2">

                <br>

                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $residencesCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span><a class="text-success" href="{{route('all.residence')}}">Consulter</a></span>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Nombre d'Immeubles</h6>
                  <div class="dropdown mb-2">

                    <br>

                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $immeublesCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-danger">
                        <span><a class="text-success" href="{{route('all.immeuble')}}">Consulter</a></span>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Nombre d'Appartements</h6>
                  <div class="dropdown mb-2">

                    <br>

                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $appartementsCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span><a class="text-success" href="{{route('all.appartement')}}">Consulter</a></span>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Nombre de Copropriétaires</h6>
                  <div class="dropdown mb-2">

                <br>

                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $coproprietairesCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span><a class="text-success" href="{{route('all.memberCoproprietaire')}}">Consulter</a></span>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Nombre de Syndics</h6>
                  <div class="dropdown mb-2">

                <br>

                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $syndicsCount }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span><a class="text-success" href="{{route('all.memberSyndic')}}">Consulter</a></span>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div> <!-- row -->



    <div class="row">
        <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Dernières Cotisations</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Copropriétaire</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestCotisations as $cotisation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cotisation->montant }}</td>
                                    <td>{{ $cotisation->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $cotisation->appartement->nom_appartement }}</td>
                                    <td>{{ $cotisation->appartement->immeuble->nom_immeuble }}</td>
                                    <td>{{ $cotisation->appartement->immeuble->residence->nom_residence }}</td>

                                    {{-- <td>
                                        @if($cotisation->status == 'paid')
                                            <span class="badge badge-success">Payé</span>
                                        @else
                                            <span class="badge badge-warning">En attente</span>
                                        @endif
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- row -->

    <div class="row">
        <div class="col-lg-7 col-xl-8 stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Derniers utilisateurs ajoutés</h6>
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Email</th>
                      {{-- <th>Date d'ajout</th> --}}
                      <th>Rôle</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($latestUsers as $user)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      {{-- <td>{{ $user->created_at->format('d/m/Y') }}</td> --}}
                      <td>{{ $user->role }}</td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- row -->


        </div>

    <div class="page-content">


			</div>

@endsection
