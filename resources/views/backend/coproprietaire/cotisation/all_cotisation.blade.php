@extends('backend.coproprietaire.coproprietaire_dashboard')

@section('coproprietaire')

<div class="page-content">
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
                                    <th>Appartement</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>
                                    <th>Propriétaire</th>
                                    <th>Syndic</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>4</td>
                                    <td>200.00</td>
                                    <td>2024-05-31</td>
                                    <td>Mai</td>
                                    <td>Appartement 1</td>
                                    <td>Immeuble 1</td>
                                    <td>Résidence 1</td>
                                    <td>Copropriétaire 1</td>
                                    <td>Syndic 1 </td>
                                    <td>
                                        <a href="" class="btn btn-inverse-warning">Editer</a>
                                        <a href="" class="btn btn-inverse-danger" id="delete">Supprimer</a>
                                    </td>
                                </tr>


                                {{-- @foreach($cotisations as $cotisation)
                                <tr>
                                    <td>{{ $cotisation->id }}</td>
                                    <td>{{ $cotisation->montant }}</td>
                                    <td>{{ $cotisation->date_cotisation }}</td>
                                    <td>{{ $cotisation->description }}</td>
                                    <td>{{ $cotisation->appartement->nom_appartement }}</td>
                                    <td>{{ $cotisation->appartement->immeuble->nom_immeuble }}</td>
                                    <td>{{ $cotisation->appartement->immeuble->residence->nom_residence }}</td>
                                    <td>{{ $cotisation->memberCoproprietaire->name }}</td>
                                    <td>{{ $cotisation->memberSyndic->user->name }}</td>
                                    <td>
                                        <a href="{{ route('coproprietaire.edit.cotisation', $cotisation->id) }}" class="btn btn-inverse-warning">Modifier</a>
                                        <form action="{{ route('coproprietaire.delete.cotisation', $cotisation->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-inverse-danger">Supprimer</button>
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
