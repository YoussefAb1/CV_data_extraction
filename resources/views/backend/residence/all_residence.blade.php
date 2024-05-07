@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.residence')}}" class="btn btn-inverse-primary">Ajouter une Résidence</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Liste des Résidences</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nom de la résidence</th>
            <th>Adresse de la résidence</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($residences as $key=>$residence)
                <tr>
                    {{-- <td>{{$key+1}}</td> --}}

                    <td>{{$residence->id}}</td>
                    <td>{{$residence->nom_residence}}</td>
                    <td>{{$residence->adresse_residence}}</td>
                    <td>
                        <a href="{{route('edit.residence',$residence->id)}}" class="btn btn-inverse-warning">Editer</a>
                        <a href="{{route('delete.residence',$residence->id)}}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
