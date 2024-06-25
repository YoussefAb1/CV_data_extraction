@extends('backend.syndic.syndic_dashboard')

@section('syndic')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('syndic.add.appartement') }}" class="btn btn-inverse-primary">Ajouter un Appartement</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Liste des Appartements</h6>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($appartements->isEmpty())
                            <p>Aucun appartement trouvé.</p>
                        @else
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Étage</th>
                                            <th>Surface</th>
                                            <th>Immeuble</th>
                                            <th>Résidence</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($appartements as $appartement)
                                            <tr>
                                                <td>{{ $appartement->nom_appartement }}</td>
                                                <td>{{ $appartement->etage }}</td>
                                                <td>{{ $appartement->surface }}</td>
                                                <td>{{ $appartement->immeuble->nom_immeuble }}</td>
                                                <td>{{ $appartement->residence->nom_residence }}</td>
                                                <td>
                                                    <a href="{{ route('syndic.edit.appartement', $appartement->id) }}" class="btn btn-inverse-warning">Editer</a>
                                                    <a href="{{ route('syndic.delete.appartement', $appartement->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
