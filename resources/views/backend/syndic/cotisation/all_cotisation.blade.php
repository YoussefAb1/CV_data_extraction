@extends('backend.syndic.syndic_dashboard')

@section('syndic')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('syndic.add.cotisation') }}" class="btn btn-inverse-primary">Ajouter une Cotisation</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Cotisations</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Montant</th>
                                    <th>Date de Cotisation</th>
                                    <th>Description</th>
                                    {{-- <th>Appartement</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>
                                    <th>Propriétaire</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cotisations as $cotisation)
                                <tr>
                                    <td>{{ $cotisation->id }}</td>
                                    <td>{{ $cotisation->montant }}</td>
                                    <td>{{ $cotisation->date_cotisation }}</td>
                                    <td>{{ $cotisation->description }}</td>
                                    {{-- <td>{{ $cotisation->appartement->nom_appartement }}</td>
                                    <td>{{ $cotisation->appartement->immeuble->nom_immeuble }}</td>
                                    <td>{{ $cotisation->appartement->immeuble->residence->nom_residence }}</td>
                                    <td>{{ $cotisation->memberCoproprietaire->name }}</td> --}}
                                    <td>
                                        <a href="{{ route('syndic.edit.cotisation', $cotisation->id) }}" class="btn btn-inverse-warning">Modifier</a>
                                        <a href="{{ route('delete.cotisation', $cotisation->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>

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
