@extends('backend.syndic.syndic_dashboard')

@section('syndic')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('syndic.add.memberCoproprietaire') }}" class="btn btn-inverse-primary">Ajouter un Copropriétaire</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Copropriétaires</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>CIN</th>
                                    <th>Type</th>
                                    {{-- <th>Utilisateur</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coproprietaires as $coproprietaire)
                                    <tr>
                                        <td>{{ $coproprietaire->id }}</td>
                                        <td>{{ $coproprietaire->name }}</td>
                                        <td>{{ $coproprietaire->cin }}</td>
                                        <td>{{ $coproprietaire->type }}</td>
                                        {{-- <td>{{ $coproprietaire->user->name }}</td> --}}
                                        <td>
                                            <a href="{{ route('syndic.edit.memberCoproprietaire', $coproprietaire->id) }}" class="btn btn-inverse-warning">Éditer</a>
                                            <a href="{{ route('syndic.delete.memberCoproprietaire', $coproprietaire->id) }}" class="btn btn-inverse-danger">Supprimer</a>
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
