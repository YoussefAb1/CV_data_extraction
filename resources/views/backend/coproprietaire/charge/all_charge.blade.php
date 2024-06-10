@extends('backend.coproprietaire.coproprietaire_dashboard')

@section('coproprietaire')

<div class="page-content">

    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('coproprietaire.add.charge') }}" class="btn btn-inverse-primary">Ajouter une Charge</a>
        </ol>
    </nav> --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Charges</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Designation</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Appartement</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($charges as $key => $charge)
                                <tr>
                                    <td>{{ $charge->id }}</td>
                                    <td>{{ $charge->designation }}</td>
                                    <td>{{ $charge->type }}</td>
                                    <td>{{ $charge->date }}</td>
                                    <td>{{ $charge->montant }}</td>
                                    <td>{{ $charge->appartement->nom_appartement }}</td>
                                    <td>{{ $charge->appartement->immeuble->nom_immeuble }}</td>
                                    <td>{{ $charge->appartement->immeuble->residence->nom_residence }}</td>
                                    <td>{{ $charge->statut }}</td>
                                    <td>
                                        <a href="{{ route('coproprietaire.edit.charge', $charge->id) }}" class="btn btn-inverse-warning">Editer</a>
                                        <a href="{{ route('coproprietaire.delete.charge', $charge->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
                                    </td>
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
