@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.permission')}}" class="btn btn-inverse-primary">Ajouter une Permission</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Liste des Permissions</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>La Permission</th>
            <th>Le Groupe</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $key=>$permission)
                <tr>
                    {{-- <td>{{$key+1}}</td> --}}

                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->group_name}}</td>
                    <td>
                        <a href="{{route('edit.permission',$permission->id)}}" class="btn btn-inverse-warning">Editer</a>
                        <a href="{{route('delete.permission',$permission->id)}}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
