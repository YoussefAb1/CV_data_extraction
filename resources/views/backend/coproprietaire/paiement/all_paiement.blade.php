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
                                    <th>Montant</th>
                                    <th>Date de Paiement</th>
                                    <th>Méthode de Paiement</th>
                                    <th>Appartement</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paiements as $paiement)
                                <tr>
                                    <td>{{ $paiement->montant }}</td>
                                    <td>{{ $paiement->date_paiement }}</td>
                                    <td>{{ $paiement->methode_paiement }}</td>
                                    <td>{{ $paiement->coproprietaireHistory->appartement->nom_appartement }}</td>
                                    <td>{{ $paiement->coproprietaireHistory->appartement->immeuble->nom_immeuble }}</td>

                                    <td>{{ $paiement->coproprietaireHistory->appartement->immeuble->residence->nom_residence }}</td>

                                    <td>
                                        <a href="{{ route('download.pdf', $paiement->id) }}" class="btn btn-danger">Télécharger Facture PDF</a>

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
