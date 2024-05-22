@extends('admin.admin_dashboard')

@section('admin')

<style>

.badge {

    --bs-badge-font-weight: 300;
    --bs-badge-border-radius: 0.25rem;
    line-height: .75;
    text-transform: uppercase;
    letter-spacing: 1px;
}


.bg-label-success {
    background-color: #36483f!important;
    color: #71dd37!important;
    padding: 0.5em 0.6em;
    border-radius: 0.30rem;
}

.bg-label-secondary {
    background-color: #393c50!important;
    color: #8592a3!important;
    padding: 0.5em 0.6em;
    border-radius: 0.30rem;
}

.bg-label-warning {
    background-color: #4d4036!important;
    color: #ffab00!important;
    padding: 0.5em 0.6em;
    border-radius: 0.30rem;
}

.bg-label-dark {
    background-color: #343a40;
    color: #000;
    padding: 0.5em 0.6em;
    border-radius: 0.30rem;
}

.bg-label-dark {
    background-color: #343a40;
    color: #fff;
    padding: 0.5em 0.6em;
    border-radius: 0.30rem;
}

</style>


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.utilisateur')}}" class="btn btn-inverse-primary">Ajouter un Utilisateur</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Utilisateurs</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom d'Utilisateur</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($utilisateurs as $key=>$utilisateur)
                                    <tr>
                                        <td>{{$utilisateur->id}}</td>
                                        <td>{{$utilisateur->name}}</td>
                                        <td>{{$utilisateur->username}}</td>
                                        <td>{{$utilisateur->email}}</td>
                                        <td>{{$utilisateur->role}}</td>
                                        <td>
                                            @if ($utilisateur->status == 'Actif')
                                                <span class="badge bg-success">Actif</span>
                                            @elseif ($utilisateur->status == 'Inactif')
                                                <span class="badge bg-secondary">Inactif</span>
                                            @elseif ($utilisateur->status == 'En attente')
                                                <span class="badge bg-warning">En attente</span>
                                                @elseif ($utilisateur->status == 'Supprimé')
                                                <span class="badge bg-danger">Supprimé</span>
                                            @else
                                                <span class="badge bg-dark">Inconnu</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('edit.utilisateur',$utilisateur->id)}}" class="btn btn-inverse-warning">Editer</a>
                                            <a href="{{route('delete.utilisateur',$utilisateur->id)}}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
