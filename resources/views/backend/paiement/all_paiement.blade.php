@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('add.paiement') }}" class="btn btn-inverse-primary">Ajouter un Paiement</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Paiements</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Montant</th>
                                    <th>Date de Paiement</th>
                                    <th>Méthode de Paiement</th>
                                    <th>Appartement</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>
                                    <th>Propriétaire</th>
                                    <th>Syndic</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paiements as $paiement)
                                <tr>
                                    <td>{{ $paiement->id }}</td>
                                    <td>{{ $paiement->montant }}</td>
                                    <td>{{ $paiement->date_paiement }}</td>
                                    <td>{{ $paiement->methode_paiement }}</td>
<<<<<<< HEAD
                                    <td>{{ $paiement->coproprietaireHistory->appartement->name ?? 'N/A' }}</td>
                                    <td>{{ $paiement->syndicHistory->immeuble->name ?? 'N/A' }}</td>
                                    <td>{{ $paiement->syndicHistory->immeuble->residence->name ?? 'N/A' }}</td>
                                    <td>{{ $paiement->coproprietaireHistory->coproprietaire->name ?? 'N/A' }}</td>
                                    <td>{{ $paiement->syndicHistory->syndic->name ?? 'N/A' }}</td>
=======
                                    <td>{{ $paiement->appartement->name }}</td>
                                    <td>{{ $paiement->coproprietaire->name }}</td>
                                    <td>{{ $paiement->syndic->name }}</td>
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
                                    <td>
                                        <a href="{{ route('edit.paiement', $paiement->id) }}" class="btn btn-inverse-warning">Modifier</a>
                                        <form action="{{ route('delete.paiement', $paiement->id) }}" method="POST" style="display:inline-block;">
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
