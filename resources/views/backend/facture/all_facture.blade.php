@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card rounded">
                    <div class="card-body">
                        <h6 class="card-title">Liste des Factures</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Numéro de Facture</th>
                                        <th>Date d'Émission</th>
                                        <th>Date d'Échéance</th>
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
                                            <a href="{{ route('edit.facture', $facture->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                            <a href="{{ route('delete.facture', $facture->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Supprimer</a>
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
</div>
@endsection
