@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('all.appartement') }}" class="btn btn-inverse-primary">Retour à la liste des appartements</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Historique des Copropriétaires pour l'Appartement {{ $appartement->nom_appartement }}</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>CIN</th>
                                    <th>Type</th>
                                    {{-- <th>Utilisateur</th> --}}
                                    <th>Date de Début</th>
                                    <th>Date de Fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coproprietaireHistories as $history)
                                <tr>
                                    <td>{{ $history->coproprietaire->name }}</td>
                                    <td>{{ $history->coproprietaire->cin }}</td>
                                    <td>{{ $history->coproprietaire->type }}</td>
                                    {{-- <td>{{ optional($history->coproprietaire->user)->name }}</td> --}}
                                    <td>{{ $history->start_date }}</td>
                                    <td>{{ $history->end_date ?? 'En cours' }}</td>
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
