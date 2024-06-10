@extends('backend.syndic.syndic_dashboard')

@section('syndic')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('syndic.add.appartement') }}" class="btn btn-inverse-primary">Ajouter un Appartement</a>
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Appartements</h6>

                    <form method="GET" action="{{ route('syndic.all.appartement') }}" class="mb-3">
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
                                        <a href="{{ route('syndic.edit.appartement', $appartement->id) }}" class="btn btn-inverse-warning">Editer</a>
                                        <a href="{{ route('syndic.delete.appartement', $appartement->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var tableId = '#dataTableExample';
                        if (!$.fn.DataTable.isDataTable(tableId)) {
                            $(tableId).DataTable();
                        } else {
                            $(tableId).DataTable().destroy();
                            $(tableId).DataTable();
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>

@endsection
