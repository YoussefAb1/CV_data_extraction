@extends('backend.coproprietaire.coproprietaire_dashboard')

@section('coproprietaire')
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
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Mes Charges<br></h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0">Designation</th>
                                    <th class="pt-0">Montant</th>
                                    <th class="pt-0">Appartement</th>
                                    <th class="pt-0">Immeuble</th>
                                    <th class="pt-0">Résidence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($charges as $charge)
                                    <tr>
                                        <td>{{ $charge->designation }}</td>
                                        <td>{{ $charge->montant }}</td>
                                        <td>{{ $charge->appartement->nom_appartement }}</td>
                                        <td>{{ $charge->appartement->immeuble->nom_immeuble }}</td>
                                        <td>{{ $charge->appartement->immeuble->residence->nom_residence }}</td>
                                        <td>{{ $charge->statut }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
