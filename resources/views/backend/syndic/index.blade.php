@extends('backend.syndic.syndic_dashboard')

@section('syndic')

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
                  <h6 class="card-title mb-0">Nombre d'Appartements</h6>
                  <div class="dropdown mb-2">


                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $nombreAppartements }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span><a class="text-success" href="{{route('syndic.all.appartement')}}">Consulter</a></span>
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
                  <h6 class="card-title mb-0">Nombre de copropriétaires</h6>

                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $nombreCoproprietaires }}</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span><a class="text-success" href="{{route('syndic.all.memberCoproprietaire')}}">Consulter</a></span>
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

        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Liste des Appartements</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Étage</th>
                                        <th>Surface</th>
                                        <th>Immeuble</th>
                                        <th>Résidence</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appartements as $appartement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $appartement->nom_appartement }}</td>
                                        <td>{{ $appartement->etage }}</td>
                                        <td>{{ $appartement->surface }} m²</td>
                                        <td>{{ $appartement->immeuble->nom_immeuble }}</td>
                                        <td>{{ $appartement->immeuble->residence->nom_residence }}</td>



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


@endsection

