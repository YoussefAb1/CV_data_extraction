@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('add.facture') }}" class="btn btn-inverse-primary">Ajouter une Facture</a></li>
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
                                    <th>ID</th>
                                    <th>Numéro de Facture</th>
                                    <th>Date d'émission</th>
                                    <th>Date d'échéance</th>
                                    <th>Montant Total</th>
                                    <th>Description</th>
                                    <th>Paiement ID</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($factures as $facture)
                                <tr>
                                    <td>{{ $facture->id }}</td>
                                    <td>{{ $facture->numero_facture }}</td>
                                    <td>{{ $facture->date_emission }}</td>
                                    <td>{{ $facture->date_echeance }}</td>
                                    <td>{{ $facture->montant_total }}</td>
                                    <td>{{ $facture->description }}</td>
                                    <td>{{ $facture->paiement_id }}</td>
                                    <td>
                                        <a href="{{ route('edit.facture', $facture->id) }}" class="btn btn-primary">Modifier</a>
                                        <form action="{{ route('delete.facture', $facture->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
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
