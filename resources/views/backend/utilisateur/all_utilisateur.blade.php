@extends('admin.admin_dashboard')

@section('admin')

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
                    {{-- <td>{{$key+1}}</td> --}}

                    <td>{{$utilisateur->id}}</td>
                    <td>{{$utilisateur->name}}</td>
                    <td>{{$utilisateur->username}}</td>
                    <td>{{$utilisateur->email}}</td>
                    <td>{{$utilisateur->role}}</td>
                    <td>{{$utilisateur->status}}</td>

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
