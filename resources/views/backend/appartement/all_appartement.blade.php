@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.appartement')}}" class="btn btn-inverse-primary">Ajouter un Appartement</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Appartements</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Appartement</th>
                                    <th>Etage</th>
                                    <th>Surface</th>
                                    <th>Immeuble</th>
                                    <th>Résidence</th>
                                    <th>Copropriétaire</th> <!-- Ajout du champ Copropriétaire -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appartements as $appartement)
                                    <tr>
                                        <td>{{ $appartement->id }}</td>
                                        <td>{{ $appartement->nom_appartement }}</td>
                                        <td>{{ $appartement->etage }}</td>
                                        <td>{{ $appartement->surface }}</td>
                                        <td>{{ $appartement->immeuble->nom_immeuble }}</td>
                                        <td>{{ $appartement->immeuble->residence->nom_residence }}</td>
                                        <td>{{ optional($appartement->memberCoproprietaire)->user->name ?? 'N/A' }}</td> <!-- Utilisation de optional et d'une valeur par défaut -->
                                        <td>
                                            <a href="{{ route('edit.appartement', $appartement->id) }}" class="btn btn-inverse-warning">Editer</a>
                                            <a href="{{ route('delete.appartement', $appartement->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
