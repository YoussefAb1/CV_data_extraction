@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
<<<<<<< HEAD
            <li class="breadcrumb-item"><a href="{{ route('add.appartement') }}" class="btn btn-inverse-primary">Ajouter un Appartement</a></li>
=======
            <a href="{{ route('add.appartement') }}" class="btn btn-inverse-primary">Ajouter un Appartement</a>
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Appartements</h6>

                    <!-- Formulaire de filtre -->
                    <form method="GET" action="{{ route('all.appartement') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="residence_id" class="form-control">
                                    <option value="">Sélectionner une résidence</option>
                                    @foreach($residences as $residence)
                                        <option value="{{ $residence->id }}" {{ request('residence_id') == $residence->id ? 'selected' : '' }}>
                                            {{ $residence->nom_residence }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="coproprietaire_id" class="form-control">
                                    <option value="">Sélectionner un copropriétaire</option>
                                    @foreach($coproprietaires as $coproprietaire)
                                        <option value="{{ $coproprietaire->id }}" {{ request('coproprietaire_id') == $coproprietaire->id ? 'selected' : '' }}>
                                            {{ $coproprietaire->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filtrer</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Appartement</th>
                                    {{-- <th>Surface</th> --}}
                                    <th>Immeuble</th>
<<<<<<< HEAD
                                    <th>Residence</th>
                                    <th>Copropriétaire Actuel</th>
=======
                                    <th>Résidence</th>
                                    <th>Copropriétaire</th>
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appartements as $appartement)
<<<<<<< HEAD
                                <tr>
                                    <td>{{ $appartement->id }}</td>
                                    <td>{{ $appartement->nom_appartement }}</td>
                                    {{-- <td>{{ $appartement->surface }}</td> --}}
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
=======
                                    <tr>
                                        <td>{{ $appartement->id }}</td>
                                        <td>{{ $appartement->nom_appartement }}</td>
                                        <td>{{ $appartement->etage }}</td>
                                        <td>{{ $appartement->surface }}</td>
                                        <td>{{ $appartement->immeuble->nom_immeuble }}</td>
                                        <td>{{ $appartement->immeuble->residence->nom_residence }}</td>
                                        <td>{{ optional($appartement->memberCoproprietaire)->name ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('edit.appartement', $appartement->id) }}" class="btn btn-inverse-warning">Editer</a>
                                            <a href="{{ route('delete.appartement', $appartement->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
                                        </td>
                                    </tr>
>>>>>>> bd045bba608f20d7eaa00d6941bf23dad4069364
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
