@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('all.immeuble') }}" class="btn btn-inverse-primary">Retour</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Historique des Syndics pour l'Immeuble: {{ $immeuble->nom_immeuble }}</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Syndic</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($syndicHistory as $history)
                                    <tr>
                                        <td>{{ $history->memberSyndic->user->name }}</td>
                                        <td>{{ $history->start_date }}</td>
                                        <td>{{ $history->end_date ?? 'Actuel' }}</td>
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
