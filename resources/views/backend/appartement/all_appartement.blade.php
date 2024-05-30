@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('add.appartement') }}" class="btn btn-inverse-primary">Ajouter un Appartement</a></li>
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
                                    <th>Surface</th>
                                    <th>Immeuble</th>
                                    <th>Residence</th>
                                    <th>Copropriétaire Actuel</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appartements as $appartement)
                                <tr>
                                    <td>{{ $appartement->id }}</td>
                                    <td>{{ $appartement->nom_appartement }}</td>
                                    <td>{{ $appartement->surface }}</td>
                                    <td>{{ $appartement->immeuble->nom_immeuble }}</td>
                                    <td>{{ $appartement->residence->nom_residence }}</td>

                                    <td>
                                        @if($appartement->coproprietaireHistories()->whereNull('end_date')->exists())
                                            {{ optional($appartement->coproprietaireHistories()->whereNull('end_date')->first()->coproprietaire->user)->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.appartement', $appartement->id) }}" class="btn btn-inverse-warning">Editer</a>
                                        <a href="{{ route('delete.appartement', $appartement->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
                                        <a href="{{ route('add.coproprietaire_to_appartement', $appartement->id) }}" class="btn btn-inverse-primary">Associer Copropriétaire</a>
                                        <a href="{{ route('history.coproprietaire_appartement', $appartement->id) }}" class="btn btn-inverse-info">Historique Copropriétaire</a>
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
