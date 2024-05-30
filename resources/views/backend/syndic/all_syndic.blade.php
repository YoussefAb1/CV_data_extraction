@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.memberSyndic') }}" class="btn btn-inverse-primary">Ajouter un Syndic</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Syndics</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                    <th>CIN</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($syndics as $syndic)
                                    <tr>
                                        <td>{{ $syndic->id }}</td>
                                        <td>{{ $syndic->user->name }}</td>
                                        <td>{{ $syndic->cin }}</td>
                                        <td>
                                            <a href="{{ route('edit.memberSyndic', $syndic->id) }}" class="btn btn-inverse-warning">Editer</a>
                                            <a href="{{ route('delete.memberSyndic', $syndic->id) }}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
