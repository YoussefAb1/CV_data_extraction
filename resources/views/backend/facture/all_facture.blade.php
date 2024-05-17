@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.facture')}}" class="btn btn-inverse-primary">Ajouter une Facture</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Factures</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Numéro de Facture</th>
                                    <th>Date d'Emission</th>
                                    <th>Date d'Echeance</th>
                                    <th>Montant Total</th>
                                    {{-- <th>Description</th> --}}
                                    <th>Nom de l'appartement </th>
                                    <th>Charge </th>
                                    <th>Etat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factures as $facture)
                                    <tr>
                                        <td>{{ $facture->numero_facture }}</td>
                                        <td>{{ $facture->date_emission }}</td>
                                        <td>{{ $facture->date_echeance }}</td>
                                        <td>{{ $facture->montant_total }}</td>
                                        <td>{{ $facture->description }}</td>
                                        <td>{{ $facture->appartement->nom_appartement}}</td>
                                        <td>{{ $facture->charge->designation }}</td>
                                        <td>
                                            <a href="{{route('edit.facture', $facture->id)}}" class="btn btn-inverse-warning">Editer</a>
                                            <a href="{{route('delete.facture', $facture->id)}}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
