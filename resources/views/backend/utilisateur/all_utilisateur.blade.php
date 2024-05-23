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
.bg-label-danger {
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

.filter-form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 1.5rem;
}

.filter-form .form-control {
    margin-right: 0.5rem;
}
</style>

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.utilisateur') }}" class="btn btn-inverse-primary">Ajouter un Utilisateur</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Utilisateurs</h6>

                    <!-- Filtrer par -->
                    <form method="GET" action="{{ route('all.utilisateur') }}" class="filter-form">
                        <select name="role" id="role" class="form-control">
                            <option value="">Tous les rôles</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <select name="status" id="status" class="form-control">
                            <option value="">Tous les statuts</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </form>

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
                                        <td>{{ $utilisateur->id }}</td>
                                        <td>{{ $utilisateur->name }}</td>
                                        <td>{{ $utilisateur->username }}</td>
                                        <td>{{ $utilisateur->email }}</td>
                                        <td>{{ $utilisateur->roles->pluck('name')->join(', ') }}</td>
                                        <td>
                                            @if ($utilisateur->status == 'actif')
                                                <span class="badge bg-label-success">Actif</span>
                                            @elseif ($utilisateur->status == 'inactif')
                                                <span class="badge bg-label-secondary">Inactif</span>
                                            @elseif ($utilisateur->status == 'En attente')
                                                <span class="badge bg-label-warning">En attente</span>
                                            @elseif ($utilisateur->status == 'Supprimé')
                                                <span class="badge bg-label-danger">Supprimé</span>
                                            @else
                                                <span class="badge bg-label-dark">Inconnu</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.utilisateur', $utilisateur->id) }}" class="btn btn-inverse-warning">Editer</a>
                                            <a href="{{ route('delete.utilisateur', $utilisateur->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
