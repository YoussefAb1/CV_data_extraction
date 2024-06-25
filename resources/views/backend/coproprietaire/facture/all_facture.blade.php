@extends('backend.coproprietaire.coproprietaire_dashboard')

@section('coproprietaire')

<div class="page-content">
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
                                    <th>Montant</th>
                                    <th>Date de Facture</th>
                                    <th>Description</th>
                                    <th>Appartement</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>
                                    <th>Propriétaire</th>
                                    <th>Syndic</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($factures as $facture)
                                <tr>
                                    <td>{{ $facture->id }}</td>
                                    <td>{{ $facture->montant }}</td>
                                    <td>{{ $facture->date_facture }}</td>
                                    <td>{{ $facture->description }}</td>
                                    <td>{{ $facture->appartement->nom_appartement }}</td>
                                    <td>{{ $facture->appartement->immeuble->nom_immeuble }}</td>
                                    <td>{{ $facture->appartement->immeuble->residence->nom_residence }}</td>
                                    <td>{{ $facture->memberCoproprietaire->name }}</td>
                                    <td>{{ $facture->memberSyndic->user->name }}</td>
                                    <td>
                                        <a href="{{ route('coproprietaire.edit.facture', $facture->id) }}" class="btn btn-inverse-warning">Modifier</a>
                                        <form action="{{ route('coproprietaire.delete.facture', $facture->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-inverse-danger">Supprimer</button>
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
