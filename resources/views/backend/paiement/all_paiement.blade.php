@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.paiement')}}" class="btn btn-inverse-primary">Ajouter un Paiement</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Liste des Paiements</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Montant</th>
            <th>Date Paiement</th>
            <th>Mode Paiement </th>
            <th>Numéro de la Facture </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($paiements as $key=>$paiement)
                <tr>
                    {{-- <td>{{$key+1}}</td> --}}

                    <td>{{$paiement->id}}</td>
                    <td>{{$paiement->nom_immeuble}}</td>
                    <td>{{$paiement->nombre_etages}}</td>
                    <td>{{$paiement->facture->numero_facture}}</td>
                    <td>
                        <a href="{{route('edit.facture',$immeuble->id)}}" class="btn btn-inverse-warning">Editer</a>
                        <a href="{{route('delete.facture',$immeuble->id)}}" class="btn btn-inverse-danger" id="delete">Supprimer</a>
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
