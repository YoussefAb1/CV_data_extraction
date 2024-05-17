@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.role')}}" class="btn btn-inverse-primary">Ajouter un Role</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Liste des Roles</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Le Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key=>$role)
                <tr>
                    {{-- <td>{{$key+1}}</td> --}}

                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>

                    <td>
                        <a href="{{route('edit.role',$role->id)}}" class="btn btn-inverse-warning">Editer</a>
                        <a href="{{route('delete.role',$role->id)}}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
