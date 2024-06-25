@extends('backend.coproprietaire.coproprietaire_dashboard')

@section('coproprietaire')

<div class="page-content">
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
                                    <th>Cotisation ID</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>5</td>
                                    <td>200.00</td>
                                    <td>2024-06-02</td>
                                    <td>Espèces</td>
                                    <td>Appartement 1</td>
                                    <td>Immeuble 1</td>
                                    <td>Résidence 1</td>
                                    <td>Copropriétaire 1</td>
                                    <td>Syndic 1 </td>
                                    <td>4</td>

                                    <td>
                                        <a href="" class="btn btn-inverse-warning">Editer</a>
                                        <a href="" class="btn btn-inverse-danger" id="delete">Supprimer</a>

                                    </td>
                                </tr>



                                {{-- @foreach($paiements as $paiement)
                                <tr>
                                    <td>{{ $paiement->id }}</td>
                                    <td>{{ $paiement->montant }}</td>
                                    <td>{{ $paiement->date_paiement }}</td>
                                    <td>{{ $paiement->methode_paiement }}</td>
                                    <td>{{ $paiement->coproprietaireHistory->appartement->nom_appartement ?? 'N/A' }}</td>
                                    <td>{{ $paiement->syndicHistory->immeuble->nom_immeuble ?? 'N/A' }}</td>
                                    <td>{{ $paiement->syndicHistory->immeuble->residence->nom_residence ?? 'N/A' }}</td>
                                    <td>{{ $paiement->coproprietaireHistory->coproprietaire->name ?? 'N/A' }}</td>
                                    <td>{{ $paiement->syndicHistory->syndic->name ?? 'N/A' }}</td>
                                    <td>{{ $paiement->cotisation->id ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('coproprietaire.edit.paiement', $paiement->id) }}" class="btn btn-inverse-warning">Modifier</a>
                                        <form action="{{ route('coproprietaire.delete.paiement', $paiement->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-inverse-danger">Supprimer</button>
                                            <a href="{{ route('download.pdf', $paiement->id) }}" class="btn btn-danger">Télécharger PDF</a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
