@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('add.immeuble') }}" class="btn btn-inverse-primary">Ajouter un Immeuble</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Immeubles</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom de l'Immeuble</th>
<<<<<<< HEAD
                                    <th>Nombre d'étages</th>
                                    <th>Résidence</th>
                                    <th>Syndic Actuel</th>
=======
                                    <th>Nombre d'Étages</th>
                                    <th>Résidence</th>
                                    <th>Syndic</th>
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($immeubles as $immeuble)
                                    <tr>
                                        <td>{{ $immeuble->id }}</td>
                                        <td>{{ $immeuble->nom_immeuble }}</td>
                                        <td>{{ $immeuble->nombre_etages }}</td>
                                        <td>{{ $immeuble->residence->nom_residence }}</td>
                                        <td>
<<<<<<< HEAD
                                            @if($immeuble->syndicHistories()->whereNull('end_date')->exists())
                                                {{ optional($immeuble->syndicHistories()->whereNull('end_date')->first()->syndic->user)->name ?? 'N/A' }}
                                            @else
                                                N/A
=======
                                            @if ($immeuble->memberSyndic)
                                                {{ $immeuble->memberSyndic->name }}
                                            @else
                                                Aucun syndic
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.immeuble', $immeuble->id) }}" class="btn btn-inverse-warning">Editer</a>
                                            <a href="{{ route('delete.immeuble', $immeuble->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
                                            <a href="{{ route('add.syndic_to_immeuble', $immeuble->id) }}" class="btn btn-inverse-primary">Associer Syndic</a>
                                            <a href="{{ route('history.syndic_immeuble', $immeuble->id) }}" class="btn btn-inverse-info">Historique Syndic</a>
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
