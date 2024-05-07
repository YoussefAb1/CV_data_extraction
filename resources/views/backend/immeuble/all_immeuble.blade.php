@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.immeuble')}}" class="btn btn-inverse-primary">Ajouter un Immeuble</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Liste des Immeubles</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nom de l'Immeuble</th>
            <th>Nombre d'étages</th>
            <th>Nom de la Résidence </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($immeubles as $key=>$immeuble)
                <tr>
                    {{-- <td>{{$key+1}}</td> --}}

                    <td>{{$immeuble->id}}</td>
                    <td>{{$immeuble->nom_immeuble}}</td>
                    <td>{{$immeuble->nombre_etages}}</td>
                    <td>{{$immeuble->residence->nom_residence}}</td>
                    <td>
                        <a href="{{route('edit.immeuble',$immeuble->id)}}" class="btn btn-inverse-warning">Editer</a>
                        <a href="{{route('delete.immeuble',$immeuble->id)}}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
